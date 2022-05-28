<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('id', 1)->exists()) {
            $user = new User();
            $user->id = 1;
            $user->name = "Super admin";
            $user->email = "admin@git.com";
            $user->password = bcrypt('Admin@123');
            $user->created_at = Carbon::now();
            $user->save();
        }
    }
}
