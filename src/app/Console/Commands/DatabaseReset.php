<?php

namespace Suavy\DatabaseResetCommandForLaravel\app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseReset extends Command
{
    protected $signature = 'db:reset
                            {--F|force : Command will launch with no warning and no production protection}';

    protected $description = 'Import database & migrate';

    private $databaseName;
    private $databasePassword;
    private $databaseUsername;

    public function __construct()
    {
        parent::__construct();
        $this->databaseName = env('DB_DATABASE');
        $this->databasePassword = env('DB_PASSWORD');
        $this->databaseUsername = env('DB_USERNAME');
    }

    public function handle()
    {
        $force = $this->option('force');
        if ($force || ((env('APP_ENV') != 'prod') && (env('APP_ENV') != 'production'))) {
            $this->warn('This command import the file "db.sql" (if exist) and launch migrations. All recent data will be deleted.');
            if ($force || $this->confirm('Are you sure ?')) {
                $this->resetDatabase();
            }
        } else {
            $this->alert('This command can\'t be used on production.');
            $this->alert('If you still want to use it, use option --force (--F shortcut).');
        }
    }

    public function resetDatabase()
    {
        $this->info('Dropping database...');
        exec("mysql --user=$this->databaseUsername --password=$this->databasePassword -e 'DROP DATABASE $this->databaseName;'");
        $this->info('Database dropped');
        $this->info('Creating database...');
        exec("mysql --user=$this->databaseUsername --password=$this->databasePassword -e 'CREATE DATABASE $this->databaseName;'");
        $this->info('Database created');
        //$this->info('Importing database...');
        //exec("mysql --user=$databaseUsername --password=$databasePassword $databaseName < db.sql");
        //$this->info('Database imported');
        $this->info('Migrating database...');
        Artisan::call('migrate');
        $this->info(Artisan::output());
        $this->info('Database migrated');
    }
}
