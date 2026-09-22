<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * @return Collection<int, string>
     */
    public static function getAllowedAuthorOptions(): Collection
    {
        $users = User::all();

        return $users->pluck('name', 'id');
    }

    /**
     * @return Collection<string, string>
     */
    public static function getAllowedAssigneeOptions(): Collection
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return $users->pluck('name', 'id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return hasMany<Task, covariant static>
     */
    public function createdTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'created_by_id');
    }

    /**
     * @return hasMany<Task, covariant static>
     */
    public function asignedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'asigned_by_id');
    }
}
