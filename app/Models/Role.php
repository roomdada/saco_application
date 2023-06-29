<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const ADMIN = 1;
    public const EMPLOYEE = 2;
    public const SUPERIOR = 3;


    public function users()
    {
        return $this->hasMany(User::class);
    }
}
