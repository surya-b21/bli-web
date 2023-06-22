<?php

namespace App\DataTables;

use App\Models\Item;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $actionBtn = Auth::user()->role_id == 3 ? '<div class="d-flex"><button class="btn btn-warning mx-1" id="edit" data-id="' . $row->id . '" data-url="' . route('item.update', $row->id) . '" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>  <a class="btn btn-danger mx-1" href="' . route('item.delete', $row->id) . '" id="delete">Delete</a></div>' : '<div class="d-flex"><button class="btn btn-warning mx-1" id="edit" data-id="' . $row->id . '" data-url="' . route('item.update', $row->id) . '" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Stock</button></div>';
                return $actionBtn;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Item $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('item-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->buttons([
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf'),
                // Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
            ->orderBy(1, 'asc');
        // ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('sku')
                ->title('SKU'),
            Column::make('nama'),
            Column::make('harga')
                ->render("$.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )"),
            Column::make('stok'),
            Column::make('unit_of_material'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Item_' . date('YmdHis');
    }
}
