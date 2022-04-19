<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard = 'admin';

    protected $guarded = ['id'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*/*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'email'    =>  [
                'required',
                Rule::unique('admins')->ignore($id, 'id')
            ],
            'password' => 'nullable|confirmed',
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'email'    => 'required|email|max:255|unique:admins',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
   */
    public function setPasswordAttribute($value='')
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarAttribute($value)
    {
        if (!$value) {
            return 'https://ui-avatars.com/api/?background=38a9e1&color=fff&rounded=true&length=1&font-size=0.43&name='.$this->attributes['first_name'];
        }

        return config('variables.avatar.public').$value;
    }
    public function setAvatarAttribute($photo)
    {
        $this->attributes['avatar'] = move_file($photo, 'avatar');
    }

    /*
    |------------------------------------------------------------------------------------
    | Boot
    |------------------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        static::updating(function($user)
        {
            $original = $user->getOriginal();

            if (Hash::check('', $user->password)) {
                $user->attributes['password'] = $original['password'];
            }
        });
    }
}
