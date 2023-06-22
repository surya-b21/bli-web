<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function getItem(Request $request)
    {
        $item = Item::orderBy('nama', 'ASC');

        if ($request->has('search')) {
            $item->where('nama', 'like', '%' . $request->input('search') . '%');
        }

        return response()->json($item->limit(10)->get());
    }
}
