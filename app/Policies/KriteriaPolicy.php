<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kriteria;

class KriteriaPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Kriteria $kriteria): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Kriteria $kriteria): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Kriteria $kriteria): bool
    {
        return $user->isAdmin();
    }
}
