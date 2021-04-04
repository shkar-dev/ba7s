<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    protected $fillable=[
        'fname',
        'lname',
        'phone'
    ];

    public function profile(){
        return $this->morphOne('App\Models\User', 'profile');
    }
}
