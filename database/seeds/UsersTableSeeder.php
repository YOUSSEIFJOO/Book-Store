<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'first_name'    => "yousseif",
            'last_name'     => "nady",
            'email'         => "super_admin@app.com",
            'password'      => 12345,
        ]);

        $user->givePermissionTo(["create users","read users","update users","delete users"]);
        $user->assignRole('super-admin');

    }
}
