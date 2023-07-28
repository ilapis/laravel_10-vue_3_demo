<?php

namespace App\Console\Commands;

use App\Models\Ability;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class ImportAbilities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:abilities {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import abilities from a CSV file';

    public function handle(): void
    {
        $filePath = $this->argument('file');

        if (! file_exists($filePath) || ! is_readable($filePath)) {
            $this->error('The file does not exist or is not readable.');

            return;
        }

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); //set the CSV header offset
        $csv->setDelimiter(','); //set the CSV delimiter to comma

        $header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords(); //returns all the CSV records as an Iterator object

        DB::transaction(function () use ($records) {
            foreach ($records as $record) {
                Ability::updateOrCreate(
                    ['name' => $record['name']],
                    ['name' => $record['name']]
                );
            }
        });

        $this->info('Import completed successfully.');
    }
}
