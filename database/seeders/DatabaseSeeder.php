<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Bouncer;

//use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Self::runAdministrator();
        Self::runUserManager();
        Self::runShopManager();
    }

    public function runAdministrator()
    {
        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'admin',
            'title' => 'Administrator',
        ]);
    
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'admin',
            'title' => 'Administrator',
        ]);
    
        Bouncer::allow($admin)->to($ban);
    }

    public function runUserManager()
    {
        $umanager = Bouncer::role()->firstOrCreate([
            'name' => 'user-manager',
            'title' => 'User Manager',
        ]);
    
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'user-manager',
            'title' => 'User manager',
        ]);
    
        Bouncer::allow($umanager)->to($ban);
    }

    public function runShopManager()
    {
        $smanager = Bouncer::role()->firstOrCreate([
            'name' => 'shop-manager',
            'title' => 'Shop Manager',
        ]);
    
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'shop-manager',
            'title' => 'Shop Manager',
        ]);
    
        Bouncer::allow($smanager)->to($ban);
    }
}
