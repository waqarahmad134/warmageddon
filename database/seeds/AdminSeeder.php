<?php

use App\User;
use App\Account;
use App\ProsixWallet;
use App\RegistrationBonus;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new \App\User();
		$user->user_name= 'properadmin';
		$user->email= 'propersix@gmail.com';
		$user->password=Hash::make('AdZpDmn@105296HHrt');
		$user->verified=1;
		$user->phone_verification=1;
        $user->save();        
        
		$user_profile =new \App\UserProfile;
		$user_profile->user_id = $user->id;
		$user_profile->username= 'properadmin';
		$user_profile->first_name= 'Proper ';
		$user_profile->last_name='Admin';
		$user_profile->base_image='1559402214.favicon.png';
		$user_profile->address='Proper Six Ltd, 137, Spinola Road, St Julians, STJ 3011, Malta';
        $user_profile->save();        
        $role_r = Role::where('name', '=','Super Admin')->firstOrFail();
		$user->assignRole($role_r);

        $account=new Account;
        
        $account->user_id=$user->id;
        $account->save();

        $wallet=new ProsixWallet;        
        $wallet->user_id=$user->id;
        $wallet->save();


        $sql="INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES        
        (1, 'Admin panel', 'web', NULL, '2020-03-07 09:38:24'),
        (2, 'Bonus And Code', 'web', NULL, '2020-03-07 09:38:45'),
        (3, 'User', 'web', NULL, NULL),
        (4, 'VIP and Loyalty', 'web', NULL, '2020-03-07 09:39:05'),
        (5, 'Missions', 'web', '2020-03-07 09:39:21', '2020-03-07 09:39:21'),
        (6, 'Casino Settings', 'web', '2020-03-07 09:39:51', '2020-03-07 09:39:51'),
        (7, 'Finances', 'web', '2020-03-07 09:40:16', '2020-03-07 09:40:16'),
        (8, 'Games Management', 'web', '2020-03-07 09:40:42', '2020-03-07 09:40:42'),
        (9, 'Security', 'web', '2020-03-07 09:40:55', '2020-03-07 09:40:55'),
        (10, 'Staff Management', 'web', '2020-03-07 09:41:14', '2020-03-07 09:41:14'),
        (11, 'User Management', 'web', '2020-03-07 09:41:31', '2020-03-07 09:41:31'),
        (12, 'Customer Information', 'web', '2020-03-07 09:44:04', '2020-03-07 09:44:04')";
         DB::insert($sql);

       /*  $per="INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
        (1, 1),
        (2, 1),
        (3, 1),
        (4, 1),
        (5, 1),
        (6, 1),
        (7, 1),
        (8, 1),
        (9, 1),
        (10, 1),
        (11, 1),
        (12, 1)";
         DB::insert($per); */
    }
}
