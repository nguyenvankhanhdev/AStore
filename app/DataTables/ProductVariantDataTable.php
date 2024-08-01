<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use App\Models\ColorProduct;
use App\Models\StorageProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductVariantDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $editBtn = "<a href='" . route('admin.products-variant.edit', $query->id) . "' class='btn btn-dark'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('admin.products-variant.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                return $editBtn.$deleteBtn;
            })
            ->editColumn('color_id', function ($query) {
                return $query->color->color; // Assuming the color name is stored in the 'color' column
            })
            ->editColumn('storage_id', function ($query) {
                return $query->storage->GB; // Assuming the storage size is stored in the 'GB' column
            })
            ->editColumn('price', function ($query) {
                return number_format($query->price, 0, ',', '.'); // Format price with thousands separator
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariant $model): QueryBuilder
    {
        $productId = request()->product;
        return $model->newQuery()
            ->with(['color', 'storage'])
            ->where('pro_id', $productId)
            ->select('product_variants.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariant-table')
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
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('quantity')->title('Quantity'),
            Column::make('price')->title('Price (VNĐ)'),
            Column::make('color_id')->title('Color'),
            Column::make('storage_id')->title('Storage'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductVariant_' . date('YmdHis');
    }
}
