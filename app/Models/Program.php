<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Program extends Model {
    use TanggalAttribute;

    protected $primaryKey = 'program_id';
    protected $appends = [
        'tanggal',
        'akumulasi',
        'fund_accumulation_percentage',
        'is_continuous',
        'is_targeted',
        'day_diff',
        'formatted_fund_target'];

    protected $casts = [
        'has_a_time_limit' => 'boolean',
    ];

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'fund_accumulation',
        'fund_target',
        'slug',
        'closed_at',
        'is_main_program',
    ];

    public static function isMainProgramExists() {
        return count(self::where('is_main_program', 1)->first());
    }

    public static function getMainProgram() {
        if (!self::isMainProgramExists()) {
            return false;
        }

        return self::where('is_main_program', 1)->first();
    }

    public function hasATimeLimit() {
        return ($this->attributes['closed_at'] != null || $this->attributes['closed_at'] != 0);
    }

    public function getAkumulasiAttribute() {
        return "Rp " . number_format($this->attributes['fund_accumulation'], 2, '.', ',');
    }

    public function getFundAccumulationPercentageAttribute() {
        if ($this->attributes['fund_target'] != 0 || $this->attributes['fund_target'] != null) {
            return (double) number_format(($this->attributes['fund_accumulation'] / $this->attributes['fund_target']) * 100, 0);
        } else {
            return null;
        }
    }

    public function getIsTargetedAttribute() {
        return ($this->attributes['fund_target'] != 0);
    }

    public function getIsContinuousAttribute() {
        return ($this->attributes['closed_at'] == null);
    }

    public function getDayDiffAttribute() {
        return Carbon::parse($this->attributes['closed_at'])->diffInDays();
    }

    /*
     * Get total program
     */
    public static function getTotalProgram() {
        return self::count();
    }

    /*
    |------------------------------------------------------------------------------------
    | Relationships
    |------------------------------------------------------------------------------------
     */

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function progress() {
        return $this->hasMany(ProgramProgress::class, 'program_id', 'program_id');
    }

    public function donator() {
        $instance = $this->hasMany(Transaction::class, 'program_id', 'program_id');
        $instance->where('status', 1);
        return $instance;
    }

    public function transactions() {
        $instance = $this->hasMany(Transaction::class, 'program_id', 'program_id');
        return $instance;
    }

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
     */

    public static function rules($update = false, $id = null) {
        $commun = [
            'title' => [
                'required',
            ],
            'description' => 'required',
            'fund_target' => 'nullable|integer',
            'closed_at' => 'nullable|date|after:tomorrow',
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'title' => [
                'required',
                'unique:programs',
            ],
            'description' => 'required',
            'fund_target' => 'nullable|integer',
            'image' => 'required',
            'closed_at' => 'nullable|date|after:tomorrow',

        ]);
    }

    public function getImageAttribute() {
        if ($this->attributes['image'] == null) {
            return 'https://placehold.jp/21/00abe2/ffffff/450x350.png?text=No%20Image';
        }

        return asset('/storage/' . $this->attributes['image']);
    }

    public function getFormattedFundTargetAttribute() {
        return 'Rp' . number_format($this->attributes['fund_target'], 2, ',', '.');
    }
}
