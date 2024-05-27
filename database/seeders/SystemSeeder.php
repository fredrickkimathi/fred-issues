<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('systems')->insert([
            'name' => 'CRIMS'
        ]);
        DB::table('systems')->insert([
            'name' => 'CySuites'
        ]);
        DB::table('systems')->insert([
            'name' => 'CyTravel'
        ]);
        //it'll have the default values
    }
}
