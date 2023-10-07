<?php

namespace App\Models\Activity;

use App\Models\Projects\Prospect;
use App\Models\Setting\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Deal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = ['deals'];

    public function prospect(): HasOne
    {
        return $this->hasOne(Prospect::class, 'id', 'prospect_id');
    }

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    public function quotation(): HasOne
    {
        return $this->hasOne(Quotation::class, 'id', 'quotation_id');
    }
}
