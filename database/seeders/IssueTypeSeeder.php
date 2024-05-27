<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IssueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('issue_types')->insert([
            'name' => 'authentication'
        ]);

        DB::table('issue_types')->insert([
            'name' => 'connection'
        ]);

        DB::table('issue_types')->insert([
            'name' => 'document upload'
        ]);

        DB::table('issue_types')->insert([
            'name' => 'others'
        ]);
    }
}
