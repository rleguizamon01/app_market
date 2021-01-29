<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientApps extends Model
{
    
    use HasFactory;

    protected $table = 'clientApp';

    protected $fillable = [
        'user_id',
        'app_id',
        'has_bought',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id'); 
    }

    public function apps(){
        return $this->belongsTo(Apps::class, 'app_id', 'app_id');
    }

}
