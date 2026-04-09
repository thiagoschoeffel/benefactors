<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $with = ['benefactor'];

    public function benefactor()
    {
        return $this->belongsTo(Benefactor::class);
    }
}
