<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            [
                'name' => 'Laravel Password Grant Client',
                'secret' => env('PASSPORT_KEY'),
                'redirect' => 'http://localhost',
                'password_client' => true,
                'personal_access_client' => false,
                'revoked' => false,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),

            ]
        ]);
        DB::table('oauth_personal_access_clients')->insert([
            [
                'client_id' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),

            ]
        ]);
    }
}
