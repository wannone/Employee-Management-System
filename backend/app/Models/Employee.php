<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'Employee';
    protected $primaryKey = 'nip';
    public $incrementing = false; // karena primary key bukan integer auto increment

    protected $fillable = [
        'nip',
        'name',
    ];

    public function information()
    {
        return $this->hasOne(Information::class, 'nip');
    }

    public function employment()
    {
        return $this->hasOne(Employement::class, 'nip');
    }
}
