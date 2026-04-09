<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefactor extends Model
{
    use HasFactory;

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
}
