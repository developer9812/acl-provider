<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegisterAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $admin = [];
        $admin['name'] = $this->ask('Name of Admin');
        $admin['username'] = $this->ask('Enter a username');
        $admin['password'] = $this->secret("Enter Password");
        $admin['email'] = $this->ask('Provide an email address');
        var_dump($admin);
    }
}
