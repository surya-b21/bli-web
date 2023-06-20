<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ItemDataTable;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

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
            "stok" => "required",
            "unit_of_material" => "required"
        ]);

        Item::create($request->all());

        return redirect()->route('item.index');
    }

    public function update(Request $request)
    {
        if (Auth::user()->role_id == 3) {
            $request->validate([
                "sku" => "required",
                "nama" => "required",
                "harga" => "required",
                "unit_of_material" => "required"
            ]);
        }
        $request->validate([
            "stok" => "required",
        ]);

        $item = Item::findOrFail($request->id);
        if (Auth::user()->role_id == 3) {
            $item->sku = $request->sku;
            $item->nama = $request->nama;
            $item->harga = $request->harga;
            $item->unit_of_material = $request->unit_of_material;
        }
        $item->stok = $request->stok;

        $item->save();

        return redirect()->route('item.index');
    }

    public function delete($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('item.index');
    }

    public function getData()
    {
        $item = Item::findOrFail($_POST['id']);

        return json_encode($item);
    }
}
