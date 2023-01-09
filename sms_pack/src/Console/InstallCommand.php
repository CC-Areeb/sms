<?php

namespace CooperativeComputing\SMS\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the SMS template and files';

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $this->AddSmsRoutes();
        $this->AddSmsController();
        $this->AddViewFiles();
    }

    // Routes
    public function AddSmsRoutes()
    {
        $source = __DIR__ . '/../../stubs/routes/web.php';
        $getSourceContent = file_get_contents($source);
        $destination = base_path('routes/web.php');
        file_put_contents($destination, $getSourceContent, FILE_APPEND);
        copy(__DIR__ . '/../../stubs/routes/sms.php', base_path('routes/sms.php'));
    }

    // Controller
    public function AddSmsController()
    {
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/SMS'));
        copy(__DIR__ . '/../../stubs/app/Http/Controllers/SMS/SmsController.php', app_path('Http/Controllers/SMS/SmsController.php'));
    }


    // Views
    public function AddViewFiles()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('views/sms'));
        copy(__DIR__ . '/../../stubs/resources/sms/index.blade.php', resource_path('views/sms/index.blade.php'));
    }
}
