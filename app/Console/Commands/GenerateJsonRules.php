<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

class GenerateJsonRules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:jsonrules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a JSON file from all form request classes. public/rules folder';

    /**
     * Execute the console command.
     */
    public function handle(Filesystem $files): int
    {
        $requestPath = app_path('Http/Requests');

        if (! $files->isDirectory($requestPath)) {
            $this->error('Directory ' . $requestPath . ' does not exist.');
            return 1;
        }

        $requestFiles = $files->allFiles($requestPath);

        foreach ($requestFiles as $file) {
            $className = $this->getClassNameFromFile($file);

            if (! class_exists($className)) {
                $this->error('Class ' . $className . ' does not exist.');
                continue;
            }

            if (method_exists($className, 'rules')) {
                $instance = new $className;

                $rules = $instance->rules();

                $json = json_encode($rules, JSON_PRETTY_PRINT);

                $publicPath = public_path('rules');

                if (! is_dir($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }

                $fileName = $publicPath . '/' . class_basename($className) . '.json';
                file_put_contents($fileName, $json);
            }
        }

        $this->info('JSON files have been generated successfully.');

        return 0;
    }

    /**
     * Get the fully qualified name of the class from the file path.
     *
     * @param  \Symfony\Component\Finder\SplFileInfo  $file
     * @return string
     */
    protected function getClassNameFromFile($file)
    {
        $namespace = 'App\\Http\\Requests';

        $class = trim(str_replace([$file->getPath(), '.php', '/'], ['', '', '\\'], $file->getPathname()), '\\');

        return $namespace . '\\' . $class;
    }
}
