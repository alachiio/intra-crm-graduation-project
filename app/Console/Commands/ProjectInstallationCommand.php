<?php

namespace App\Console\Commands;

use App\Enums\LeadSourceEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;

class ProjectInstallationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'intra:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('migrating tables to database...');
        Artisan::call('migrate:fresh');
        $this->info('creating super admin...');
        Artisan::call('admin:create');
        $this->info('inserting countries from api...');
        Artisan::call('countries:insert');
        $this->info('seeding data into database...');
        Artisan::call('db:seed');

        $this->info('project has been installed successfully, you can login as super admin with: \\n email: admin@admin.com \\n password:admin123');
    }
}
