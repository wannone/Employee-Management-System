<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;

    protected $table = 'Religion';
    protected $primaryKey = 'id';
    public $incrementing = true;
    
    protected $fillable = [
        'name',
    ];

    public function information()
    {
        return $this->hasMany(Information::class, 'religion_id');
    }
}
