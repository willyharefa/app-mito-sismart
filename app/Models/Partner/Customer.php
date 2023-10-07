<?php

namespace App\Models\Partner;

use App\Models\Projects\Prospect;
use App\Models\Setting\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = 'customers';
    
    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    public function prospect(): BelongsTo
    {
        return $this->belongsTo(Prospect::class, 'id', 'customer_id');
    }
}
