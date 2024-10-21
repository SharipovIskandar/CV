<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetworkStudent extends Model
{
    use HasFactory;
    protected $table = 'social_network_student';

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'student_id',
        'social_network_id',
        'username',

    ];

}
