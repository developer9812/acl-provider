<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\Router;
use Spatie\Permission\Models\Permission;

class PermissionCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'permission:generate
                            {--resource=  : Name of resource for which permission needs to be created}
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
          if (is_array($resources)) {
            foreach ($resources as $key => $resource) {
              // $this->info($resource);
              $this->storePermissions($resource);
            }
          }
        }
      }
      if ($this->option('prune')) {
        $this->prunePermissions($permissions);
      }
    }

    private function storePermissions($permission)
    {
      if (Permission::where('name', '=', $permission)->exists()) {
        $this->info('Permission Already Exists: ' . $permission);
      } else {
        $this->info('Creating Permission: ' . $permission);
        Permission::create(['name' => $permission]);
      }
    }

    private function prunePermissions($permissions)
    {
      $storedPermissions = Permission::all();
      foreach ($storedPermissions as $storedPermission) {
        if ($this->checkPermission($storedPermission, $permissions)) {
          $this->info('Removing Permission >> ' . $storedPermission->name);
          $storedPermission->delete();
        }
      }
    }

    private function checkPermission($stored, $all)
    {
      $prune = true;
      array_walk_recursive($all, function($permission) use (&$prune, $stored){
        if ($stored->name == $permission) {
          $this->info('Stored >> ' . $stored->name);
          $this->info('Permission >> ' . $permission);
          $prune = false;
        }
      });
      return $prune;
    }
}
