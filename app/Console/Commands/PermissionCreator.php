<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\Router;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'permission:generate
                            {--resource=  : Name of resource for which permission needs to be created}
                            {--admin= : Create or update an admin role with all permissions}
                            {--prune : Remove unnecessary permissions if any exists}';

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
      $permissions = config('permissionmap');
      if ($this->option('resource')){
        $this->info("Getting Permissions for resource >> " . $this->option( 'resource'));
        if (isset($permissions[$this->option('resource')])) {
          foreach ($permissions[$this->option('resource')] as $key => $permission) {
            // $this->info($permission);
            $this->storePermissions($permission);
          }
        } else {
          $this->error("Resource Not Found");
        }
      } else {
        $this->info("Getting all permissions");
        foreach ( $permissions as $key => $resources) {
          $this->info("Key " . $key);
          if (is_array($resources)) {
            foreach ($resources as $key => $resource) {
              // $this->info($resource);
              $this->storePermissions($resource);
            }
          }
        }
      }
      if ($this->option('prune')) {
        $this->info("Started Pruning");
        $this->prunePermissions($permissions);
        $this->info("Pruning Done ..");
      }
      if ($this->option('admin')) {
        $this->makeAdmin($this->option('admin'));
      }
    }

   /**
    * Stores Individual Permission if it does not exist in the database
    * @param  string $permission [Name of permission to be stored]
    * @return void
    */
    private function storePermissions(string $permission)
    {
      if (Permission::where('name', '=', $permission)->exists()) {
        $this->info('Permission Already Exists: ' . $permission);
      } else {
        $this->info('Creating Permission: ' . $permission);
        Permission::create(['name' => $permission]);
      }
    }

   /**
    * Removes permissions which are not in the master list in config file
    * @param  array $permissions [All permissions from config file]
    * @return void
    */
    private function prunePermissions(array $permissions)
    {
      $storedPermissions = Permission::all();
      foreach ($storedPermissions as $storedPermission) {
        if ($this->checkPermission($storedPermission, $permissions)) {
          $this->info('Removing Permission >> ' . $storedPermission->name);
          $storedPermission->delete();
        }
      }
    }

   /**
    * Check if permission exists in master list
    * @param  Permission $stored [Existing permission from database]
    * @param  array      $all    [All Permission from config file]
    * @return void
    */
    private function checkPermission(Permission $stored, array $all)
    {
      $prune = true;
      array_walk_recursive($all, function($permission) use (&$prune, $stored){
        if ($stored->name == $permission) {
          $prune = false;
        }
      });
      return $prune;
    }

   /**
    * Make Master Admin Role
    * This role will be given all permissions in the app
    * @param  string $role [Name of Admin Role]
    * @return void
    */
    private function makeAdmin(string $role)
    {
        if (Role::whereName($role)->exists()){
          $this->updateAdminRole($role);
        } else {
          $this->createAdminRole($role);
        }
    }

   /**
    * Update existing Admin Role
    * @param  string $role [Name of role to be updated]
    * @return void
    */
    private function updateAdminRole(string $role)
    {
      $this->info('Updating Role >> ' . $role);
      $admin = Role::whereName($role)->first();
      $this->syncAdminPermissions($admin);
    }

    /**
     * Create new Admin Role
     * @param  string $role [Name of new role to be created]
     * @return void
     */
    private function createAdminRole(string $role)
    {
      $this->info('Creating Role >> ' . $role);
      $admin = new Role();
      $admin->name = $role;
      $admin->parent_id = 0;
      $admin->owner_id = 0;
      $admin->save();
      $this->syncAdminPermissions($admin);
    }

   /**
    * Grant all permissions to the Admin Role
    * @param  Role   $admin [Admin Role]
    * @return void
    */
    private function syncAdminPermissions(Role $admin)
    {
      $this->info("Syncing Permissions ");
      $admin->syncPermissions( Permission::all()->pluck('name') );
      $this->info("Admin Role sync done..");
    }
}
