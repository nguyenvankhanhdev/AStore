<?php

namespace App\DataTables;

use App\Models\TopProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use App\Models\Products;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TopProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', '')
            ->addColumn('image', function ($query) {
                return "<img width='70px' src='" . asset($query->image) . "' ></img>";
            })
            ->addColumn('soluongmua', function ($query) {
                return $query->variants->flatMap(function ($variant) {
                    return $variant->variantColors->flatMap(function ($variantColor) {
                        return $variantColor->orderDetails;
                    });
                })->sum('quantity');
            })
            ->addColumn('type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return '<i class="badge badge-success">New Arrival</i>';
                        break;
                    case 'featured_product':
                        return '<i class="badge badge-warning">Featured Product</i>';
                        break;
                    case 'top_product':
                        return '<i class="badge badge-info">Top Product</i>';
                        break;
                    case 'best_product':
                        return '<i class="badge badge-danger">Best Product</i>';
                        break;
                    case 'sale_product':
                        return '<i class="badge badge-primary">Sale Product</i>';
                        break;
                    case 'accessory':
                        return '<i class="badge badge-secondary">Accessory</i>';
                        break;
                    default:
                        return '<i class="badge badge-dark">None</i>';
                        break;
                }
            })
            ->rawColumns(['action', 'image','soluongmua','type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Products $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('variants.variantColors.orderDetails');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('topproduct-table')
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
            Column::make('id')->addClass('text-center')->title('ID')->width(100),
            Column::make('name')->addClass('text-center')->title('Tên sản phẩm')->width(150),
            Column::make('image')->addClass('text-center')->title('Ảnh')->width(150),
            Column::make('type')->addClass('text-center')->title('Type')->width(150),
            Column::make('soluongmua')->addClass('text-center')->title('Số lượng mua')->width(150),
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
        return 'TopProduct_' . date('YmdHis');
    }
}
