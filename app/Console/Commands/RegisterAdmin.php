<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Models\Role;

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
        $admin['username'] = $this->ask('Enter a username. (Min 5 chars)');
        $admin['password'] = $this->secret("Enter Password. (Min 8 chars)");
        $admin['email'] = $this->ask('Provide an email address');

        $roles = Role::all(['name'])->pluck('name')->toArray();
        $defaultRole = null;
        if (array_search('admin', $roles) === false) {
          $defaultRole = array_search('admin', $roles);
        }
        $admin['role'] = $this->choice('Select Role', $roles, $defaultRole);

        if (strlen($admin['username']) <= 4) {
          $this->error("Username must be atleast 5 character long");
          return;
        } elseif (strlen($admin['password']) <= 7) {
          $this->error("Password is too short. Atleast 8 chars are required");
          return;
        }

        $user = new User();
        $user->username = $admin['username'];
        $user->name = $admin['name'];
        $user->password = bcrypt($admin['password']);
        $user->email = $admin['email'];
        $user->save();
        $user->assignRole('admin');
        $this->info("Admin User Created Successfully with all permissions");
    }
}
