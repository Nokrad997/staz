<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'surname',
        'password',
        'email',
        'phone_number',
    ];
}
