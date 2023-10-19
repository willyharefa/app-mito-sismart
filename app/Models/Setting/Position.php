<?php

namespace App\Models\Setting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Position extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = 'positions';

    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class, 'id', 'position_id');
    }
}
