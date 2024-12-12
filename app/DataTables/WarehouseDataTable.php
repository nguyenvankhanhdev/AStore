<?php

namespace App\DataTables;

use App\Models\Warehouse;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class WarehouseDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return "<a href='" . route('admin.warehouse.show', $query->id) . "' class='btn btn-primary'>View</a>";
            })
            ->addColumn('import_date', function ($query) {
                return date('d-M-Y', strtotime($query->import_date));
            })
            ->addColumn('total_quantity', function ($query) {
                return number_format($query->total_quantity);
            })
            ->addColumn('total_price', function ($query) {
                return number_format($query->total_price, 0, '.', ',') . ' đ';
            })
            ->rawColumns(['action']);
    }

    public function query(Warehouse $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('warehouse-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['excel', 'csv', 'print', 'reload'],
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('import_date')->title('Ngày nhập'),
            Column::make('total_quantity')->title('Tổng mặt hàng'),
            Column::make('total_price')->title('Tổng tiền')->width('20%'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center')
        ];
    }

    protected function filename(): string
    {
        return 'Warehouses_' . date('YmdHis');
    }
}
