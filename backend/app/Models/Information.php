<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'Information';
    protected $primaryKey = 'nip';
    public $incrementing = false;

    protected $fillable = [
        'nip',
        'birthplace',
        'birthdate',
        'gender',
        'religion_id',
        'address',
        'phone',
        'npwp',
        'image_url'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'nip');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }
}
