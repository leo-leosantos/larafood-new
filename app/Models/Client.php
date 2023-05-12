<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\user as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Client extends  Authenticatable
{

    use HasApiTokens;

    protected $fillable = ['name', 'email', 'password'];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function evaluations()
    {
        return $this->belongsToMany(Evaluation::class);
    }
}
