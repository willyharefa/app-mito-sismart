<?php

namespace App\Models\Inventory;

use App\Models\Activity\Jartest;
use App\Models\Activity\QuotationItem;
use App\Models\Setting\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = 'stocks';

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'id', 'stock_id');
    }
    
    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    public function jartest(): BelongsTo
    {
        return $this->belongsTo(Jartest::class, 'id', 'stock_id');
    }

    public function quotationItem(): HasMany
    {
        return $this->hasMany(QuotationItem::class, 'stock_id');
    }
}
