<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;

use Bouncer;



class AssignUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Self::Administrator();
        //Self::ShopManager();
        Self::UserManager();
    }

    public function Administrator()
    {
        $user = User::firstOrCreate([
                    'name' => 'Admin',
                    'date_of_birth'=>'1995-01-01',
                    'email' => 'admin@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make(12345678), 
                    'remember_token' => Str::random(10)
               ]);
        $bouncer = Bouncer::create($user);
        Bouncer::assign('admin')->to($user);
        Bouncer::allow($user)->to('admin');
        Bouncer::allow($user)->toOwnEverything();
    }

    public function ShopManager()
    {
        $user = User::firstOrCreate([
                    'name' => 'Shop Manager',
                    'date_of_birth'=>'1992-01-01',
                    'email' => 'shopmanager@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make(12345678), 
                    'remember_token' => Str::random(10)
               ]);
        $bouncer = Bouncer::create($user); 
        Bouncer::assign('shop-manager')->to($user);
        Bouncer::allow($user)->to('shop-manager');
        Bouncer::allow($user)->toOwn(Product::class);
        Bouncer::allow($user)->toOwn(Order::class);
    }

    public function UserManager()
    {
        $user = User::firstOrCreate([
                    'name' => 'User Manager',
                    'date_of_birth'=>'1990-01-01',
                    'email' => 'usermanager@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make(12345678), 
                    'remember_token' => Str::random(10)
               ]);
        $bouncer = Bouncer::create($user); 
        Bouncer::assign('user-manager')->to($user);
        Bouncer::allow($user)->to('user-manager');
        Bouncer::allow($user)->toOwn(Customer::class);
    }
}
