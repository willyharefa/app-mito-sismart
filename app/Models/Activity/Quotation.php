<?php

namespace App\Models\Activity;

use App\Models\Projects\Prospect;
use App\Models\Setting\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quotation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = ['quotations'];
    protected $casts = [
        'date_quotation' => 'datetime'
    ];

    public function prospect(): HasOne
    {
        return $this->hasOne(Prospect::class, 'id', 'prospect_id');
    }

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    public function quotationItem(): HasMany
    {
        return $this->hasMany(QuotationItem::class, 'quotation_id');
    }

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class, 'id', 'quotation_id');
    }
}
