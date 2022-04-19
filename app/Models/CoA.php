<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class CoA extends Model
{
    protected $table = 'coa';
    protected $primaryKey = 'coa_number';
    protected $fillable = [
        'coa_number',
        'bank_account',
        'description',
        'title',
        'is_active',
        'bank_name',
        'email'
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $coa_number = null)
    {
        $commun = [
            'coa_number'    => [
                'required',
                Rule::unique('coa')->ignore($coa_number, 'coa_number')
            ],
            'title' => 'required',
            'bank_account' => 'required',
            'email' => 'required',
            'bank_name' => 'required',
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'coa_number'    => "required|unique:coa,coa_number",
            'bank_account' => 'required',
            'title' => 'required',
            'email' => 'required',
            'bank_name' => 'required',
        ]);
    }
}
