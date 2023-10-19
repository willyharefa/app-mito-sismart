<?php

namespace App\Models\Projects;

use App\Models\Activity\Deal;
use App\Models\Activity\Introduction;
use App\Models\Activity\Mapping;
use App\Models\Activity\Penetration;
use App\Models\Activity\Quotation;
use App\Models\Partner\Customer;
use App\Models\Setting\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Prospect extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['date_start'];
    protected $tables = 'prospects';

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    public function mapping(): BelongsTo
    {
        return $this->belongsTo(Mapping::class, 'id', 'prospect_id');
    }

    public function introduction(): BelongsTo
    {
        return $this->belongsTo(Introduction::class, 'id', 'prospect_id');
    }

    public function penetration(): BelongsTo
    {
        return $this->belongsTo(Penetration::class, 'id', 'prospect_id');
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'id', 'prospect_id');
    }

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class, 'id', 'prospect_id');
    }
}
