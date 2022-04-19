<?php

namespace App;

use App\Models\Transaction;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use Notifiable, HasRoles;
    protected $primaryKey = "user_id";
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['user_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
     */
    public static function rules($update = false, $id = null) {
        $commun = [
            'email' => [
                'required',
                Rule::unique('users')->ignore($id, 'user_id'),
            ],
            'password' => 'nullable|confirmed',
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
     */
    public function setPasswordAttribute($value = '') {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarAttribute($value) {
        if (!$value) {
            return 'https://ui-avatars.com/api/?background=38a9e1&color=fff&rounded=true&length=1&font-size=0.43&name=' . $this->attributes['first_name'];
        }

        return config('variables.avatar.public') . $value;
    }
    public function setAvatarAttribute($photo) {
        $this->attributes['avatar'] = move_file($photo, 'avatar');
    }

    /*
    |------------------------------------------------------------------------------------
    | Boot
    |------------------------------------------------------------------------------------
     */
    public static function boot() {
        parent::boot();
        static::updating(function ($user) {
            $original = $user->getOriginal();

            if (\Hash::check('', $user->password)) {
                $user->attributes['password'] = $original['password'];
            }
        });
    }

    /*
    |------------------------------------------------------------------------------------
    | Relationship
    |------------------------------------------------------------------------------------
     */

    public function transactions() {
        return $this->hasMany(Transaction::class, 'user_id', 'user_id');
    }

    /*
    |------------------------------------------------------------------------------------
    | Additional Method
    |------------------------------------------------------------------------------------
     */

    public function getDonator() {

    }

    public function getAdmin() {

    }

    public function getFullName() {
        return $this->attributes['first_name'] . " " . $this->attributes['last_name'];
    }

}
