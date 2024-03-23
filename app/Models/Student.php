<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;


class Student extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'password',
        'image'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
