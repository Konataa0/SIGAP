<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kegiatan;

class KegiatanPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Kegiatan $kegiatan): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Kegiatan $kegiatan): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Kegiatan $kegiatan): bool
    {
        return $user->isAdmin();
    }
}
