<?php

namespace App\Policies;

use App\Models\DiaryEntry;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiaryEntryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the diary entry.
     *
     * @param User $user
     * @param DiaryEntry $diaryEntry
     * @return mixed
     */
    public function view(User $user, DiaryEntry $diaryEntry)
    {
        return (int)$diaryEntry->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the diary entry.
     *
     * @param User $user
     * @param DiaryEntry $diaryEntry
     * @return mixed
     */
    public function update(User $user, DiaryEntry $diaryEntry)
    {
        return (int)$diaryEntry->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the diary entry.
     *
     * @param User $user
     * @param DiaryEntry $diaryEntry
     * @return mixed
     */
    public function delete(User $user, DiaryEntry $diaryEntry)
    {
        return (int)$diaryEntry->user_id === $user->id;
    }
}
