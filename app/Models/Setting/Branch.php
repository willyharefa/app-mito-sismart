<?php

namespace App\Models\Setting;

use App\Models\Activity\Deal;
use App\Models\Activity\Introduction;
use App\Models\Activity\Mapping;
use App\Models\Activity\Negotiation;
use App\Models\Activity\Penetration;
use App\Models\Activity\Quotation;
use App\Models\Inventory\Stock;
use App\Models\Projects\Prospect;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function Ramsey\Uuid\v1;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = 'branches';

    public function stocks(): BelongsTo
    {
        return $this->belongsTo(Stock::class, 'id', 'branch_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'id', 'branch_id');
    }

    public function prospect(): BelongsTo
    {
        return $this->belongsTo(Prospect::class, 'id', 'branch_id');
    }

    public function mapping(): BelongsTo
    {
        return $this->belongsTo(Mapping::class, 'id', 'branch_id');
    }

    public function introduction(): BelongsTo
    {
        return $this->belongsTo(Introduction::class, 'id', 'branch_id');
    }

    public function penetration(): BelongsTo
    {
        return $this->belongsTo(Penetration::class, 'id', 'branch_id');
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'id', 'branch_id');
    }

    public function negotiation(): BelongsTo
    {
        return $this->belongsTo(Negotiation::class, 'id', 'branch_id');
    }

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class, 'id', 'branch_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'branch_id');
    }
}
