<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    protected $table = 'registrasi';
    protected $primaryKey = 'registrasi_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'registrasi_id',
        'registrasi_info',
        'registrasi_url',
        'registrasi_fullname',
        'registrasi_email'
    ];
}
