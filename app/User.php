<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function todos() {

        return $this->hasMany('App\Todo');
    }

    public function owns($model) {
        
        return $this->id == $model->user_id;
    }

    public function generateApiToken() {

        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
    
}
