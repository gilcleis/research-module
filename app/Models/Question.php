<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['name','dimension_id','status'];

    public function dimension()
    {
        return $this->belongsTo(Dimension::class);
    }
}
