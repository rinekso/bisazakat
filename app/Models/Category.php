<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'coa_number',
        'name',
        'description'
    ];

    /*
   |------------------------------------------------------------------------------------
   | Relationships
   |------------------------------------------------------------------------------------
   */

    public function coa()
    {
        return $this->belongsTo(CoA::class, 'coa_number', 'coa_number');
    }

    /*
   |------------------------------------------------------------------------------------
   | Validations
   |------------------------------------------------------------------------------------
   */
    public static function rules($update = false, $category_id = null)
    {
        $commun = [
            'coa_number'    => "required|exists:coa,coa_number",
            'name'    => [
                'required',
                Rule::unique('categories')->ignore($category_id, 'category_id')
            ],
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'coa_number'    => "required|exists:coa,coa_number",
            'name' => 'required|unique:categories,name',
        ]);
    }
}
