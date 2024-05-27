<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            'name' => 'open'
        ]);
        DB::table('statuses')->insert([
            'name' => 'pending'
        ]);
        DB::table('statuses')->insert([
            'name' => 'in progress'
        ]);
        DB::table('statuses')->insert([
            'name' => 'resolved'
        ]);
        DB::table('statuses')->insert([
            'name' => 'closed'
        ]);
    }
}
