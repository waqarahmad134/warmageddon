<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use App\Account;
use App\RegistrationBonus;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 		// test 
		$user_c=new User;
        $user_c->user_name = 'Test-user';
        $user_c->email='propersix.bd@gmail.com';
        $user_c->dob=date('Y-m-d');
        $user_c->country= 19;
        $user_c->country_code=880;
        $user_c->phone=1764824777;
        $user_c->password=Hash::make('12345678');
		$user_c->ip_address= \Request::ip();
		$user_c->verified=1;
		$user_c->phone_verification=1;
        $user_c->save();        
        $user_c_profile =new \App\UserProfile;
        $user_c_profile->user_id = $user_c->id;
        $user_c_profile->first_name ='test';
        $user_c_profile->last_name ='user';
        $user_c_profile->username ='test-user';
        $user_c_profile->address = 'North-West Frontier';
        $user_c_profile->country = 19;
        $user_c_profile->state = 'North-West Frontier';
        $user_c_profile->gender = 'M';
        $user_c_profile->base_image = 'user/profile/avatar.png'; 
        $user_c_profile->zipcode =1230;
        $user_c_profile->phone_number =1764824777;
        $user_c_profile->date_of_birth ='1997-01-09';
        $user_c_profile->save();
        $account=new Account;
        $account->user_id=$user_c->id;
        $account->save();
            //bonus
            $bonus=new \App\Bonus;
            $bonus->user_id=$user_c->id;
            $bonus->amount= 50;
            $bonus->type='registration_bonus';
            $bonus->from='casino';
            $bonus->to=$user_c->user_name;
            $bonus->save();
            // notification
            $notification=new \App\Notification;
            $notification->user_id=$user_c->id;
            $notification->message='You got '.$bonus->amount.'$ bonus for registration';
            $notification->save();
            //balance
            $account=Account::find($account->id);
            $account->total= $bonus->amount;
            $account->save();

            $balance=new \App\Balance;
            $balance->method_id=$bonus->id;
            $balance->balance=$bonus->amount;
            $balance->amount_sign='i';
            $balance->user_id=$user_c->id;
            $balance->account_id=$account->id;
            $balance->type='registration_bonus';
            $balance->from='casino';
            $balance->to=$user_c->user_name;
            $balance->save();
            $earning_game = new GameEarning;
            $earning_game->user_id=$user_c->id;
            $earning_game->save(); 
        //account            
        $role_user = Role::where('name', '=','User')->firstOrFail();
        $user_c->assignRole($role_user);


		$user_ceo=new User;
        $user_ceo->user_name = 'bigtime';
        $user_ceo->email='tillbigtime@gmail.com';
        $user_ceo->dob='1997-01-09';
        $user_ceo->country= 213;
        $user_ceo->country_code=46;
        $user_ceo->phone=734042990;
        $user_ceo->password= '$2y$10$cwvJYjvnqAkCzstPW0XfD.ndcrQBHiTuIhvY/fNjHmcOS.BJnZyAi';
		$user_ceo->ip_address= '141.101.69.15';
		$user_ceo->verified=1;
		$user_ceo->phone_verification=1;
        $user_ceo->save();        
        $user_ceo_profile =new \App\UserProfile;
        $user_ceo_profile->user_id = $user_ceo->id;
        $user_ceo_profile->first_name ='mats';
        $user_ceo_profile->last_name ='johansson';
        $user_ceo_profile->username ='bigtime';
        $user_ceo_profile->address = 'björkallen 37';
        $user_ceo_profile->country = 213;
        $user_ceo_profile->state = 'Vasternorrland';
        $user_ceo_profile->gender = 'M';
        $user_ceo_profile->base_image ='user/profile/1575160321-5de30a01cc8ca.jpg'; 
        $user_ceo_profile->zipcode =86040;
        $user_ceo_profile->phone_number ='0046734042990';
        $user_ceo_profile->date_of_birth ='1997-01-09';
        $user_ceo_profile->save();
        $account=new Account;
        $account->user_id=$user_ceo->id;
        $account->save();
            //bonus
            $bonus=new \App\Bonus;
            $bonus->user_id=$user_ceo->id;
            $bonus->amount= 50;
            $bonus->type='registration_bonus';
            $bonus->from='casino';
            $bonus->to=$user_ceo->user_name;
            $bonus->save();
            // notification
            $notification=new \App\Notification;
            $notification->user_id=$user_ceo->id;
            $notification->message='You got '.$bonus->amount.'$ bonus for registration';
            $notification->save();
            //balance
            $account=Account::find($account->id);
            $account->total= $bonus->amount;
            $account->save();

            $balance=new \App\Balance;
            $balance->method_id=$bonus->id;
            $balance->balance=$bonus->amount;
            $balance->amount_sign='i';
            $balance->user_id=$user_ceo->id;
            $balance->account_id=$account->id;
            $balance->type='registration_bonus';
            $balance->from='casino';
            $balance->to=$user_ceo->user_name;
            $balance->save();
            $earning_game = new GameEarning;
            $earning_game->user_id=$user_ceo->id;
            $earning_game->save(); 
				
        //account            
        $role_user = Role::where('name', '=','User')->firstOrFail();
        $user_ceo->assignRole($role_user);

        /// 1 
		$user_ct=new User;
        $user_ct->user_name = 'kaleem';
        $user_ct->email='engkal46166@gmail.com';
        $user_ct->dob='1990-05-10';
        $user_ct->country= 167;
        $user_ct->country_code=92;
        $user_ct->phone=3025545846;
        $user_ct->password='$2y$10$XOrWan0HQadB8eiefhsuLO47S1Enz0xonJ./4n7MjOz0B2KLpVvku';
		$user_ct->ip_address= '172.69.225.4';
		$user_ct->verified=1;
		$user_ct->phone_verification=1;
        $user_ct->save();        
        $user_ct_profile =new \App\UserProfile;
        $user_ct_profile->user_id = $user_ct->id;
        $user_ct_profile->first_name ='test';
        $user_ct_profile->last_name ='user';
        $user_ct_profile->username ='kaleem';
        $user_ct_profile->address = 'Dhaka';
        $user_ct_profile->country = 167;
        $user_ct_profile->state = 'Dhaka';
        $user_ct_profile->gender = 'M';
        $user_ct_profile->base_image = 'user/profile/avatar.png'; 
        $user_ct_profile->zipcode =1230;
        $user_ct_profile->phone_number =3025545846;
        $user_ct_profile->date_of_birth ='1990-05-10';
        $user_ct_profile->save();
        $account=new Account;
        $account->user_id=$user_ct->id;
        $account->save();
            //bonus
            $bonus=new \App\Bonus;
            $bonus->user_id=$user_ct->id;
            $bonus->amount= 50;
            $bonus->type='registration_bonus';
            $bonus->from='casino';
            $bonus->to=$user_ct->user_name;
            $bonus->save();
            // notification
            $notification=new \App\Notification;
            $notification->user_id=$user_ct->id;
            $notification->message='You got '.$bonus->amount.'$ bonus for registration';
            $notification->save();
            //balance
            $account=Account::find($account->id);
            $account->total= $bonus->amount;
            $account->save();

            $balance=new \App\Balance;
            $balance->method_id=$bonus->id;
            $balance->balance=$bonus->amount;
            $balance->amount_sign='i';
            $balance->user_id=$user_ct->id;
            $balance->account_id=$account->id;
            $balance->type='registration_bonus';
            $balance->from='casino';
            $balance->to=$user_ct->user_name;
            $balance->save();

            $earning_game = new GameEarning;
            $earning_game->user_id=$user_ct->id;
            $earning_game->save(); 
				
        //account            
        $role_user = Role::where('name', '=','User')->firstOrFail();
        $user_ct->assignRole($role_user);

      



    }
}
