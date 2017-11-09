<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\User;
use Carbon\Carbon;

class MigrateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usermaster:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $client;

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
        $this->info('This command will migrate users from mongo db to maria of oauth server');
        $username = $this->ask("Enter Username");
        $password = $this->secret("Enter Password");
        $this->client = new Client(['base_uri' => 'http://192.168.1.74:3000/api/users/']);
        try{

          $response = $this->client->post('login', [
              'json' => [
                'username' => $username,
                'password' => $password
              ]
          ]);
          $responseData = json_decode($response->getBody()->getContents());
          $token = $responseData->id;
          $this->info("TOKEN RECEIVED");
          $this->info($token);
          $this->getUsers($token);

        } catch (ClientException $e) {
          $response = $e->getResponse();
          $error = json_decode($response->getBody()->getContents())->error;
          // var_dump($error);
          if ($error->status == 401) {
            $this->info("Invalid Credentials");
          }
        }
    }

    private function getUsers(string $token)
    {
      $this->info("FETCHING USERS");
      try {
        $response = $this->client->get('', [
          'query' => [
            'access_token' => $token
          ]
        ]);
        $users = json_decode($response->getBody()->getContents());
        // var_dump($users);
        foreach($users as $userMaster) {
          $this->getUserDetail($userMaster, $token);
          $this->info('Dumping User Details');
          // var_dump($userMaster);
        }
      } catch(ClientException $e) {
          $response = $e->getResponse();
          $error = json_decode($response->getBody()->getContents())->error;
          // var_dump($error);
      }
    }

    private function getUserDetail($userMaster, $token)
    {
      $this->info("Fetchin User Detail of " . $userMaster->username);
      try{
        $response = $this->client->get($userMaster->id.'/userDetails',  [
          'query' => [
            'access_token' => $token
          ]
        ]);
        $userDetail = json_decode($response->getBody()->getContents());
        // var_dump($userDetail);
        $this->syncUser($userMaster, $userDetail);

      } catch(ClientException $e) {
          $response = $e->getResponse();
          $error = json_decode($response->getBody()->getContents())->error;
          // var_dump($error);
      }
    }

    private function syncUser($userMaster, $userProfile)
    {
      $user = null;
      $this->info("USER ID >> " . $userMaster->id);
      if (User::whereUserId($userMaster->id)->exists()) {
        $user = User::whereUserId($userMaster->id)->first();
        $this->info("Dumping existing user");
        var_dump($user);
      } elseif (User::whereUsername($userMaster->username)->exists()) {
        $user = User::whereUsername($userMaster->username)->first();
        $this->info("Dumping existing user by username");
        var_dump($user);
      }
      else {
        $user = new User();
        $this->info("Dumping NEW user");
        var_dump($user);
      }
      $this->saveUser($user, $userMaster, $userProfile);
    }

    private function saveUser(User $user, $userMaster, $userDetail)
    {
      $user->user_id = $userMaster->id;
      $user->username = $userMaster->username;
      $user->email = $userMaster->email;
      $user->name = $userDetail->name->first_name . " " . $userDetail->name->second_name . " " . $userDetail->name->last_name;
      $user->created_at = Carbon::parse($userDetail->created_at);
      $status = $user->save();
      if ($status) {
        $this->info("Dumping created user");
        var_dump($user);
      } else {
        $this->info("Failed to save user . " . $userMaster->username);
      }
    }


}
