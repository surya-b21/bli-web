<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function get()
    {
        $transaksi = Transaksi::where('sort', request('sort'))->get();

        return response()->json($transaksi);
    }

    public function invoice()
    {
        $transaksi = Transaksi::select('sort', 'created_at')->where('user_id', Auth::user()->id)->groupBy(['sort', 'created_at'])->get();

        $collection = array();

        $romans = [
            "01" => 'I',
            "02" => 'II',
            "03" => 'III',
            "04" => 'IV',
            "05" => 'V',
            "06" => 'VI',
            "07" => 'VII',
            "08" => 'VIII',
            "09" => 'IX',
            "10" => 'X',
            "11" => 'XI',
            "12" => 'XII',
        ];

        foreach ($transaksi as $data) {
            $romawi = $romans[$data->created_at->format('m')];
            $invoice = "INV/" . $romawi . "/" . $data->created_at->format('Y') . "/" . $data->sort;

            array_push($collection, $invoice);
        }

        dd($collection);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.item_id' => 'required',
            '*.qty' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        // get number of transaction
        $transaksi = Transaksi::select('sort')->orderBy('sort', 'desc')->first();

        $collection = array();
        $now = Carbon::now('utc')->toDateTimeString();

        for ($i = 0; $i < count($request->all()); $i++) {
            $data = array();
            if (!isset($transaksi->sort)) {
                $data['sort'] = 1;
            } else {
                $data['sort'] = $transaksi->sort + 1;
            }

            $data['created_at'] = $now;
            $data['updated_at'] = $now;
            $data['item_id'] = $request->all()[$i]['item_id'];
            $data['qty'] =  $request->all()[$i]['qty'];
            $data['user_id'] = Auth::user()->id;

            // find item price
            $item = Item::select('harga')->where('id', $data['item_id'])->first();
            $hps = (($data['qty'] * $item->harga) * 0.11) + $item->harga;

            $data['harga_setelah_pajak'] = $hps;

            array_push($collection, $data);
        }

        Transaksi::insert($collection);

        return response()->json(['message' => 'success']);
    }
}
