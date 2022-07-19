<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
     protected $fillable = [
        'name', 'school_id', 'order'
    ];
     
      public function school()
    {
        return $this->belongsTo(School::class);
    }

}
