<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey='cid';
    protected $table='clienti';

    protected $fillable = [
        'nome', // Add nome to the fillable property
        'cognome',
        'cellulare',
        'email',
        'citta',
        'tipo',
        'status',
        'note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
