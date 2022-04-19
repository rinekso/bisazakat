<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use TanggalAttribute;

    public const PENDING = 0;
    public const SUCCESS = 1;
    public const EXPIRED = 2;

    protected $primaryKey = 'transaction_id';
    protected $guarded = ['transaction_id'];

    protected $appends = ['is_expired', 'jatuh_tempo', 'rupiah', 'tanggal'];


    public function payment()
    {
        return $this->hasOne(Payment::class, 'transaction_uuid', 'transaction_uuid');
    }

    public function getRouteKeyName()
    {
        return 'transaction_uuid';
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function proofOfTransfer()
    {
        return $this->belongsTo(ProofOfPayment::class, 'proof_of_payment_id', 'proof_of_payment_id');
    }

    public function getRupiahFormat()
    {
        return "Rp". number_format($this->attributes['amount'],0,',','.');
    }

    public function getIsExpiredAttribute()
    {
        return Carbon::parse($this->attributes['expired_at'])->lessThan(Carbon::now());
    }

    public function getJatuhTempoAttribute()
    {
        return Carbon::parse($this->attributes['expired_at'])->format('j F Y, H:i');
    }

    public function getRupiahAttribute()
    {
        return "Rp ". number_format($this->attributes['amount'], 0, ',', '.');
    }


}
