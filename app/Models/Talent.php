<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    protected $table = 'talent';
    protected $fillable = [
        'name', 'category', 'label', 'image', 'is_active',
        'height', 'bust', 'waist', 'hips', 'shoe_size'
    ];

    public function images()
    {
        return $this->hasMany(TalentImage::class);
    }
}
