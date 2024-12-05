<?php

namespace App\DataTables;

use App\Models\VariantColors;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VariantColorsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addIndexColumn()
        ->addColumn('action', function($query){
            $editBtn = "<a href='" . route('admin.variant-colors.edit', $query->id) . "' class='btn btn-dark'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='".route('admin.variant-colors.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
            return $editBtn.$deleteBtn;
        })
        ->editColumn('color_id', function ($query) {
            return $query->color->name;
        })
        ->editColumn('offer_price', function ($query) {
            return number_format($query->offer_price, 0, ',', '.');
        })
        ->editColumn('price', function ($query) {
            return number_format($query->price, 0, ',', '.');
        })
        ->rawColumns(['action'])
        ->setRowId('id');


    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VariantColors $model): QueryBuilder
    {
        $variantId = request()->variants;
        return $model->newQuery()
        ->where('variant_id', $variantId)
        ->select('variant_colors.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('variantcolor-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])
                    ->parameters([
                        'scrollX' => true, // Bật chế độ cuộn ngang
                        'responsive' => true, // Hỗ trợ giao diện responsive
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('STT'),
            Column::make('color_id')->title('Color'),
            Column::make('quantity'),
            Column::make('price')->title('Price (VND'),
            Column::make('offer_price')->title('Offer Price (VND'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VariantColor_' . date('YmdHis');
    }
}
