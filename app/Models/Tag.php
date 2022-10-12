<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function getPivot() {
        return $this->hasMany(MovieTag::class, 'tag_id', 'id');
    }
}
