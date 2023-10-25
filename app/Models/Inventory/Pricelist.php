<?php

namespace App\Models\Inventory;

use App\Models\Management\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pricelist extends Model
{
    use HasFactory;
    protected $guarded = 'id';
    protected $tables = 'pricelists';


    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
    
    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class, 'id', 'stock_id');
    }
}
