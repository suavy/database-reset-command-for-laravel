<?php

namespace Suavy\DatabaseResetCommandForLaravel\app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseReset extends Command
{
    protected $signature = 'db:reset
                            {--F|force : Launch with no warning and no production protection}
                            {--I|import : Import db.sql file located at root of your project}';

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
            $this->warn('Your database will be reset and migrations launched.');
            $this->warn('Be careful, all recent data will be deleted!');
            if ($force || $this->confirm('Are you sure ?')) {
                $this->resetDatabase();
            }
        } else {
            $this->alert('This command can\'t be used on production');
            $this->alert('If you still want to use it, use option --force (or --F)');
        }
    }

    public function resetDatabase()
    {
        $this->info('Dropping database...');
        exec("mysql --user=$this->databaseUsername --password=$this->databasePassword -e 'DROP DATABASE $this->databaseName;'");
        $this->info('Creating database...');
        exec("mysql --user=$this->databaseUsername --password=$this->databasePassword -e 'CREATE DATABASE $this->databaseName;'");
        if($this->option('import')) {
            $this->info('Importing database...');
            exec("mysql --user=$this->databaseUsername --password=$this->databasePassword $this->databaseName < db.sql");
        }
        $this->info('Migrating database...');
        Artisan::call('migrate');
        $this->info(Artisan::output());
    }
}