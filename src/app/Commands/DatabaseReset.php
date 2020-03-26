<?php

namespace Suavy\DatabaseResetCommandForLaravel\app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import database & migrate';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle() {
        if((env('APP_ENV') != 'prod') && (env('APP_ENV') != 'production')) {
            $this->warn('This command import the file "db.sql" (if exist) and launch migrations. All recent data will be deleted.');
            if($this->confirm('Are you sure ?')) {
                $databaseName = env('DB_DATABASE');
                $databasePassword = env('DB_PASSWORD');
                $databaseUsername = env('DB_USERNAME');
                $this->info('Dropping database...');
                exec("mysql --user=$databaseUsername --password=$databasePassword -e 'DROP DATABASE $databaseName;'");
                $this->info('Database dropped');
                $this->info('Creating database...');
                exec("mysql --user=$databaseUsername --password=$databasePassword -e 'CREATE DATABASE $databaseName;'");
                $this->info('Database created');
                //$this->info('Importing database...');
                //exec("mysql --user=$databaseUsername --password=$databasePassword $databaseName < db.sql");
                //$this->info('Database imported');
                $this->info('Migrating database...');
                Artisan::call('migrate');
                $this->info(Artisan::output());
                $this->info('Database migrated');
            }
        } else {
            $this->alert('This command can\'t be used on production env.');
            $this->alert('If you still want to do it, please change your APP_ENV to anything else than "prod" or "production".');
        }
    }

}
