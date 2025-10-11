<?php

namespace Modules\ResellersPanel\Models;

use Filament\Panel;
use Illuminate\Support\Str;
use App\Enums\UserGenderEnum;
use App\Enums\UserDepartmentEnum;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\ResellersPanel\Database\Factories\ShopUserFactory;

class ShopUser extends User
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'personal_id',
        'first_name',
        'last_name',
        'gender',
        'national_id',
        'phone',
        'email',
        'password',
        'address',
        'active',
        'password_changed',
        'profile_photo_path',
        'is_owner',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = ['profile_photo_url', 'name'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gender' => UserGenderEnum::class,
            'department' => UserDepartmentEnum::class,
            'phone_verified_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->profile_photo_url;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    /**
     * Accessor for the profile photo URL.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        // If the user has a profile picture path, return its full URL
        if ($this->profile_photo_path) {
            return private_file_url($this->profile_photo_path);
        }

        // Otherwise, return the default profile picture URL
        return asset('build/images/avatars/' . $this->gender->value . '.png');
    }

    // protected static function newFactory(): ShopUserFactory
    // {
    //     // return ShopUserFactory::new();
    // }
}
