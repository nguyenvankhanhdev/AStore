<?php

namespace App\DataTables;

use App\Models\WarehouseDetail;
use App\Models\WarehouseDetails;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WarehouseDetailDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('variant_color', function ($query) {
                if ($query->variantColor && $query->variantColor->variant) {
                    $variant = $query->variantColor->variant;
                    $product = $variant->product;

                    $colorName = $query->variantColor->color->name ?? 'N/A';
                    $storage = $variant->storage['GB'] ?? 'N/A';

                    return $product->name . ' - ' . $colorName . ' - ' . $storage;
                }

                return 'N/A';
            })
            ->addColumn('quantity', function ($query) {
                return number_format($query->quantity);
            })
            ->addColumn('warehouse_price', function ($query) {
                return number_format($query->warehouse_price, 0, '.', ',') . ' đ';
            })
            ->addColumn('total_price', function ($query) {
                return number_format($query->total_price, 0, '.', ',') . ' đ';
            });
    }

    public function query(WarehouseDetails $model)
    {
        $query = $model->newQuery();

        if ($this->request()->has('warehouse_id')) {
            $warehouseId = $this->request()->get('warehouse_id');
            $query->where('warehouse_id', $warehouseId);
        } else {
            logger('warehouse_id not found in DataTable request');
        }

        return $query->with('variantColor');
    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('warehouse-detail-table')
            ->columns($this->getColumns())
            ->minifiedAjax('', null, [
                'warehouse_id' => 'function() { return ' . request()->route('id') . '; }',
            ])
            ->orderBy(0)
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['excel', 'csv', 'print', 'reload'],
            ])
            ->parameters([
                'scrollX' => true, // Bật chế độ cuộn ngang
                'responsive' => true, // Hỗ trợ giao diện responsive
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width('10%'),
            Column::make('variant_color')->title('Tên sản phẩm')->width('25%'),
            Column::make('quantity')->title('Số lượng')->width('15%'),
            Column::make('warehouse_price')->title('Giá nhập')->width('15%'),
            Column::make('total_price')->title('Tổng tiền')->width('15%'),
        ];
    }

    protected function filename(): string
    {
        return 'WarehouseDetails_' . date('YmdHis');
    }
}
