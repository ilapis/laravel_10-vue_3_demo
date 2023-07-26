<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class RefreshTestDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:refresh_test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the test database structure without Telescope tables';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting refresh of test database...');

        $originalDbName = env('DB_DATABASE');
        $testDbName = 'test';

        // Exclude Telescope tables from the export
        $excludeTables = [
            'telescope_entries',
            'telescope_monitoring',
            'telescope_entries_tags',
        ];

        // Export the structure of the original database
        $this->info('Exporting structure of original database...');
        $this->exportDatabaseStructure($originalDbName, $excludeTables);

        // Create a new database for the test environment
        $this->info('Creating new test database...');
        $this->createTestDatabase($testDbName);

        // Import the structure into the test database
        $this->info('Importing structure into test database...');
        $this->importDatabaseStructure($testDbName);

        // Grant access to the test database for the user
        $this->info('Granting access to test database...');
        $this->grantAccessToTestDatabase($testDbName);

        $this->info('Successfully refreshed test database.');

        return 0;
    }

    /**
     * Export the structure of the original database, excluding specified tables.
     *
     * @param  string[]  $excludeTables
     */
    protected function exportDatabaseStructure(string $database, array $excludeTables): void
    {
        $username = 'root'; //env('DB_USERNAME');
        $password = env('DB_PASSWORD_ROOT'); //env('DB_PASSWORD');
        $host = env('DB_HOST');
        $port = env('DB_PORT');

        $dumpFile = storage_path('database_structure.sql');

        $excludeTablesString = implode(' ', array_map(function ($table) use ($database) {
            return "--ignore-table=$database.$table";
        }, $excludeTables));

        $exportCommand = "mysqldump -h $host -P $port -u $username -p$password --no-data --routines $excludeTablesString $database > $dumpFile";
        $exportProcess = Process::fromShellCommandline($exportCommand);
        $exportProcess->run();

        if (! $exportProcess->isSuccessful()) {
            $this->error('Failed to export database structure: '.$exportProcess->getErrorOutput());
            exit(1);
        }
    }

    /**
     * Create a new database for the test environment.
     */
    protected function createTestDatabase(string $database): void
    {
        $createDatabaseStatement = "CREATE DATABASE IF NOT EXISTS $database";
        DB::connection('mysql_root')->getPdo()->exec($createDatabaseStatement);
    }

    /**
     * Import the database structure into the test database.
     */
    protected function importDatabaseStructure(string $database): void
    {
        $username = 'root'; //env('DB_USERNAME');
        $password = env('DB_PASSWORD_ROOT'); //env('DB_PASSWORD');
        $host = env('DB_HOST');
        $port = env('DB_PORT');

        $dumpFile = storage_path('database_structure.sql');

        $importCommand = "mysql -h $host -P $port -u $username -p$password $database < $dumpFile";
        $importProcess = Process::fromShellCommandline($importCommand);
        $importProcess->run();

        if (! $importProcess->isSuccessful()) {
            $this->error('Failed to import database structure: '.$importProcess->getErrorOutput());
            exit(1);
        }

        // Delete the dump file
        @unlink($dumpFile);
    }

    /**
     * Grant access to the test database for a user.
     */
    protected function grantAccessToTestDatabase(string $database): void
    {
        $username = env('DB_USERNAME');

        $grantAccessStatement = "GRANT ALL PRIVILEGES ON $database.* TO '$username'@'%'";
        DB::connection('mysql_root')->getPdo()->exec($grantAccessStatement);

        $flushPrivilegesStatement = 'FLUSH PRIVILEGES';
        DB::connection('mysql_root')->getPdo()->exec($flushPrivilegesStatement);
    }
}
