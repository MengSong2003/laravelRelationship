<?php

namespace App\Models;

use Faker\Provider\ar_EG\Address;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function Address(){
        return $this->hasOne(address::class,'user_id');
    }
    public static function getUsers($user_id=0){
        $data = [];
        $entries = User::all();
        if($entries){
            foreach($entries as $value){
                $result_data['id'] = $value->id;
                $result_data['name'] = $value->name;
                $result_data['email'] = $value->email;
                $data[] = $result_data;
            }
        }
        return $data;
    }
}
