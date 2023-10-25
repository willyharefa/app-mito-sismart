<?php

namespace App\Models\Management;

use App\Models\Inventory\Pricelist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    protected $guarded = 'id';
    protected $tables = 'cities';

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'id', 'city_id');
    }
}
