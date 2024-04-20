<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 *
 * @property int $id
 * @property int $type
 * @property string $name
 * @property string $phone
 * @property string $link_page_a
 * @property int $is_active
 *
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'link_page_a',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
     * @return hasMany
     */
    protected function luckyNumbers(): hasMany
    {
        return $this->hasMany(Lucky::class);
    }
//
//    /**
//     * Perform pre-authorization checks.
//     */
//    public function before(User $user, string $ability): bool|null
//    {
//        if ($user->isAdministrator()) {
//            return true;
//        }
//
//        return null;
//    }

    /**
     * Check if the user is an administrator.
     *
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->type == UserTypes::ADMIN;
    }
}
