<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ItemDataTable;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(ItemDataTable $dataTable)
    {
        return $dataTable->render('item');
    }

    public function store(Request $request)
    {
        $request->validate([
            "sku" => "required",
            "nama" => "required",
            "harga" => "required",
            "unit_of_material" => "required"
        ]);

        Item::create($request->all());

        return redirect()->route('item.index');
    }
}
