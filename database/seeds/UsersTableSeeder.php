<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();
        $adminRoles = Roles::where('name', 'admin')->first();
        $authorRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();

        $admin = Admin::create([
            'admin_name' => 'canhadmin',
            'admin_email' => 'canhadmin@gmail.com',
            'admin_phone' => '12345678',
            'admin_password' => md5('canhadmin')
        ]);
        $author = Admin::create([
            'admin_name' => 'canhauthor',
            'admin_email' => 'canhauthor@gmail.com',
            'admin_phone' => '12345678',
            'admin_password' => md5('canhauthor')
        ]);
        $user = Admin::create([
            'admin_name' => 'canhuser',
            'admin_email' => 'canhuser@gmail.com',
            'admin_phone' => '12345678',
            'admin_password' => md5('canhuser')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
        
        factory(App\Admin::class, 30)->create();
    }
}
