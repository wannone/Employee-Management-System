<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'Unit';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name',
    ];

    public function employement()
    {
        return $this->hasMany(Employement::class, 'unit_id');
    }
}
