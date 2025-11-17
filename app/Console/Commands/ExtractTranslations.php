<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExtractTranslations extends Command
{
    protected $signature = 'translations:extract {--lang=en.json}';
    protected $description = 'Scan project for translation calls and write them into JSON lang file';

    public function handle()
    {
        $langFile = $this->option('lang');
        $jsonPath = lang_path($langFile);

        // Directories to scan
        $directories = [
            resource_path('views'),
            app_path(),
        ];

        // Regex patterns to detect translation usages
        $patterns = [
            // __("...") or __('...')
            '/__\(["\']([^"\']+)["\']\)/',


            // @lang("...") or @lang('...')
            '/@lang\(["\']([^"\']+)["\']\)/',


            // trans("...") or trans('...')
            '/trans\(["\']([^"\']+)["\']\)/',


            // trans_choice("...") or trans_choice('...')
            '/trans_choice\(["\']([^"\']+)["\']\)/',
        ];

        $found = [];

        foreach ($directories as $dir) {
            $files = File::allFiles($dir);

            foreach ($files as $file) {
                $content = $file->getContents();

                foreach ($patterns as $pattern) {
                    if (preg_match_all($pattern, $content, $matches)) {
                        foreach ($matches[1] as $text) {
                            $text = str_replace("\\'", "'", $text);

                            $found[$text] = ""; // Store as key=value
                        }
                    }
                }
            }
        }

        // --- Load existing JSON file ---
        $existing = [];
        if (File::exists($jsonPath)) {
            $existing = json_decode(File::get($jsonPath), true);
            if (!is_array($existing)) {
                $existing = [];
            }
        }

        // --- Remove duplicates from existing JSON ---
        $existing = array_unique($existing);

        // --- Merge: existing on top, new keys appended after ---
        $merged = $existing;

        foreach ($found as $key => $value) {
            if (!isset($merged[$key])) {
                $merged[$key] = $value;
            }
        }

        // OPTIONAL: If you want alphabetical sorting: uncomment ↓
        // ksort($merged);

        // Save output
        File::put(
            $jsonPath,
            json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        $this->info("Found " . count($found) . " translation keys.");
        $this->info("Saved to: $langFile");
        $this->info("Total keys after merge: " . count($merged));

        return Command::SUCCESS;
    }
}
