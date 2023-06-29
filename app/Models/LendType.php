<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LendType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lends()
    {
        return $this->hasMany(Lend::class);
    }
}
