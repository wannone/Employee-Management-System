<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eselon extends Model
{
    use HasFactory;

    protected $table = 'Eselon';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name',
    ];

    public function employement()
    {
        return $this->hasMany(Employement::class, 'eselon_id');
    }
}
