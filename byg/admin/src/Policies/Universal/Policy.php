<?php

namespace Byg\Admin\Policies\Universal;

use App\Models\System\Website;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class Policy
{
    protected $table;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        if(auth()->user()->isSuperAdmin()) return true;
        return in_array("{$this->table}.index", auth()->user()->group?->permissions??[]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if(auth()->user()->isSuperAdmin()) return true;
        return in_array("{$this->table}.store", auth()->user()->group?->permissions??[]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Website $website): bool
    {
        if(auth()->user()->isSuperAdmin()) return true;
        return in_array("{$this->table}.update", auth()->user()->group?->permissions??[]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Website $website): bool
    {
        if(auth()->user()->isSuperAdmin()) return true;
        return in_array("{$this->table}.destroy", auth()->user()->group?->permissions??[]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Website $website): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Website $website): bool
    {
        //
    }
}
