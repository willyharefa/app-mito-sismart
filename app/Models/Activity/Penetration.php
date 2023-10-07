<?php

namespace App\Models\Activity;

use App\Models\Projects\Prospect;
use App\Models\Setting\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penetration extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = ['penetrations'];
    protected $casts = [
        'date_penetration' => 'datetime'
    ];

    public function prospect(): HasOne
    {
        return $this->hasOne(Prospect::class, 'id', 'prospect_id');
    }

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
}
