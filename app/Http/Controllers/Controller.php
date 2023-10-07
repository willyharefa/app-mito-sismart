<?php

namespace App\Http\Controllers;

use App\Models\Activity\Quotation;
use App\Models\Activity\QuotationItem;
use App\Models\Inventory\Stock;
use App\Models\Projects\Prospect;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function error()
    {
        return view('components.errors.400');
    }

    public function getProductId($id)
    {
        $stock = Stock::find($id);
        return response()->json($stock);
    }

    public function getIdProspect($id)
    {
       $quotation = Quotation::where('prospect_id', $id)->with('prospect', 'branch', 'quotationItem')->first();
       $quotationItem = QuotationItem::where('quotation_id', $quotation->id)->with('stock')->get();
       $prospect = Prospect::find($id)->with('customer')->first();
       return response()->json([
        'quotation' => $quotation,
        'prospect' => $prospect,
        'quotationItem' => $quotationItem
       ]);
    }
}
