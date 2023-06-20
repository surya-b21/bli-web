<?php

namespace App\Http\Controllers;

use App\DataTables\TransaksiDataTable;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(TransaksiDataTable $dataTable)
    {
        return $dataTable->render('transaksi');
    }
}
