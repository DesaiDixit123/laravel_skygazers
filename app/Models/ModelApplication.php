<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelApplication extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'country',
        'age',
        'gender',
        'height',
        'measurements',
        'affiliate_code',
        'instagram',
        'telegram',
        'whatsapp_number',
        'status'
    ];
}
