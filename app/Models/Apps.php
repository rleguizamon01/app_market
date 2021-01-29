<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apps extends Model
{
    use HasFactory;

    protected $primaryKey = 'app_id';

    protected $fillable = [
        'name',
        'price',
        'photo',
        'category'
    ];

    public function clientapps(){
        return $this->hasMany(ClientApps::class, 'app_id', 'app_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($clientApp) { // before delete() method call this
             $clientApp->clientapps()->delete();
             // do the rest of the cleanup...
        });
    }
}
