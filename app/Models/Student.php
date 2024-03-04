<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'email' => 'unique',
        'phone' => 'unique',
        'password',
        'image'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
