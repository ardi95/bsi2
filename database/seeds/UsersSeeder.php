<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat role admin
		$adminRole = new Role();
		$adminRole->name = "admin";
		$adminRole->display_name = "Admin";
		$adminRole->save();
		// Membuat role member
		$memberRole = new Role();
		$memberRole->name = "member";
		$memberRole->display_name = "Member";
		$memberRole->save();
		// Membuat sample admin
		$admin = new User();
		$admin->name = 'Admin Larapus';
		$admin->email = 'admin@gmail.com';
		$admin->password = bcrypt('rahasia');
		$admin->alamat = 'Taman wisma asri 2 blok CC31 No.9';
		$admin->kontak = '089674256264';
		$admin->save();
		$admin->attachRole($adminRole);
		// Membuat sample member
		$member = new User();
		$member->name = "Sample Member";
		$member->email = 'member@gmail.com';
		$member->password = bcrypt('rahasia');
		$member->alamat = 'Villa gading baru blok E3 No.12A';
		$member->kontak = '08158242095';
		$member->save();
		$member->attachRole($memberRole);
    }
}
