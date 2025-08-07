<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersLogs extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'action_model',
        'action_id',
    ];

    public function users()
    {
        return $this->hasOne('App\Models\Auth\User', 'id', 'user_id');
    }
}