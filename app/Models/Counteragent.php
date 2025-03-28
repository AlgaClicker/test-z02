<?php

namespace App\Models;
use Ramsey\Uuid\Uuid;

use Illuminate\Database\Eloquent\Model;

class Counteragent extends Model
{


    //
    protected $fillable = [
        'inn',
        'name',
        'address',
        'ogrn',
        'user_id'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4();
        });
    }
}
