<?php

namespace Modules\ResellersPanel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ResellersPanel\Database\Factories\ShopCustomersFactory;

class ShopCustomer extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'organization',
        'birthday',
        'national_id',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'birthday' => 'datetime',
        'phone_verified_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];
}
