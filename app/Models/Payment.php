<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    protected $guarded = ['payment_id'];

    public const PENDING = 0;
    public const SETTLED = 1;
    public const FAILED = 2;

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
        return $this->transaction->user;
    }

    public function getRouteKeyName()
    {
        return 'payment_uuid';
    }
}
