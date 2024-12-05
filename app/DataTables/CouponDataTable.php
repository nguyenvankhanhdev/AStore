<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<button class="btn btn-primary redeem-coupon" data-id="' . $query->id . '">Đổi</button>';
            })
            ->editColumn('discount', function ($query) {
                if ($query->discount_type == 'percent') {
                    return $query->discount . '%';
                } else {
                    return number_format($query->discount *1000, 0,',','.') . 'đ';
                }
            })
            ->editColumn('start_date', function ($query) {
                return date('d-m-Y', strtotime($query->start_date));
            })
            ->editColumn('end_date', function ($query) {
                return date('d-m-Y', strtotime($query->end_date));
            })
            ->setRowId('id');
    }

    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('coupon-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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

    public function getColumns(): array
    {
        return [
            Column::make('discount')->title('Giá trị voucher cho đơn hàng')->width(300),
            Column::make('required_points')->title('Điểm cần đổi')->width(200),
            Column::make('start_date')->title('Ngày bắt đầu')->width(200)->addClass('text-center'),
            Column::make('end_date')->title('Ngày kết thúc')->width(200)->addClass('text-center'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(150)
            ->addClass('text-center')->title('Nút'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Coupon_' . date('YmdHis');
    }
}
