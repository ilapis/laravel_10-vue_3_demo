<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use App\Models\Translation;
use League\Csv\Reader;

class ImportTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:translations {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import translations from a CSV file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath) || !is_readable($filePath)) {
            $this->error("The file does not exist or is not readable.");
            return;
        }

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); //set the CSV header offset
        $csv->setDelimiter(','); //set the CSV delimiter to comma

        $header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords(); //returns all the CSV records as an Iterator object

        DB::transaction(function () use ($records) {
            foreach ($records as $record) {
                $language = Language::firstWhere('code', $record['language']);

                if ($language) {
                    Translation::updateOrCreate(
                        [
                            'language_id' => $language->id,
                            'group' => $record['group'],
                            'key' => $record['key'],
                        ],
                        ['value' => $record['value']]
                    );
                } else {
                    $this->error("Import failed: Language with code {$record['language']} does not exist.");
                }
            }
        });

        $this->info("Import completed successfully.");
    }
}
