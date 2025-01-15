<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'Abdelrahman eid',
            'email' => 'aeid38858@gmail.com',
            'password' => Hash::make('842003..'),
            'store_id' => Store::inRandomOrder()->first()->id
        ]);
    }
}
