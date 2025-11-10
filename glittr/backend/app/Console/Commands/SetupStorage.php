<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupStorage extends Command
{
    protected $signature = 'setup:storage';
    protected $description = 'Setup storage link and ensure directories exist';

    public function handle()
    {
        // Create storage directories if they don't exist
        $directories = [
            storage_path('app/public/profile_images'),
            storage_path('app/public/product_images'),
        ];

        foreach ($directories as $directory) {
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
                $this->info("Created directory: {$directory}");
            }
        }

        // Create storage link
        $this->call('storage:link');
        
        $this->info('Storage setup completed successfully!');
    }
}