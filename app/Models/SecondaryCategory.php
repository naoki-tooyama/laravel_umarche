<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\PrimaryCategory;

class SecondaryCategory extends Model
{
    use HasFactory;

    public function primary(){
        return $this->belongsTo(PrimaryCategory::class);
    }
}
