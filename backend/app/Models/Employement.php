<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employement extends Model
{
    use HasFactory;

    protected $table = 'Employement';
    protected $primaryKey = 'nip';
    public $incrementing = false;

    protected $fillable = [
        'nip',
        'position',
        'group_id',
        'eselon_id',
        'unit_id',
        'workplace_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'nip');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function eselon()
    {
        return $this->belongsTo(Eselon::class, 'eselon_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function workplace()
    {
        return $this->belongsTo(Workplace::class, 'workplace_id');
    }
}
