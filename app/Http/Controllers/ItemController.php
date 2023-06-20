<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ItemDataTable;

class ItemController extends Controller
{
    public function index(ItemDataTable $dataTable)
    {
        return $dataTable->render('item');
    }
}
