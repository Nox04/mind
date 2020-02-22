<?php

use App\Models\DiaryEntry;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function (User $user) {
            $diaryEntries = factory(DiaryEntry::class, 7)->make();
            $user->diaryEntries()->saveMany($diaryEntries);
        });
    }
}
