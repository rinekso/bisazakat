<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramProgress extends Model
{
    use TanggalAttribute;

    protected $table = 'program_progress_updates';
    protected $primaryKey = 'program_progress_update_id';
    protected $guarded = ['program_progress_update_id'];
    protected $appends = ['tanggal'];

    public static function rules($update = false, $id = null)
    {
        $rules = [
            'title'    => 'required',
            'description' => 'required',
        ];

        return $rules;

    }
}
