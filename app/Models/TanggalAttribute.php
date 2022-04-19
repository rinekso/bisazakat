<?php


namespace App\Models;


trait TanggalAttribute
{

    public function getTanggalAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)
            ->format('d, F Y');
    }
}