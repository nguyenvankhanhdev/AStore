<?php

namespace App\DataTables;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DeliveredOrderDataTable extends DataTable
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
            ->addColumn('action', function ($query) {
                $showBtn = "<a href='" . route('admin.orders.show', $query->id) . "' class='btn btn-primary'><i class='far fa-eye'></i></a>";
                return $showBtn;
            })
            ->addColumn('customer_name', function ($query) {
                return optional($query->user->userAddress)->name ?? 'N/A';
            })
            ->addColumn('amount', function ($query) {
                return number_format($query->total_amount, 0, '.', ',') . 'đ';
            })
            ->addColumn('date', function ($query) {
                return date('d-M-Y', strtotime($query->order_date));
            })
            ->addColumn('order_status', function ($query) {
                switch ($query->status) {
                    case 'delivered':
                        return "<span class='badge bg-success'>Đang giao hàng</span>";
                    default:
                        return "<span class='badge bg-secondary'>Unknown</span>";
                }
            })
            ->addColumn('payment_status', function ($query) {
                switch ($query->payment_status) {
                    case 'pending':
                        return "<span class='badge bg-warning'>Pending</span>";
                    case 'completed':
                        return "<span class='badge bg-success'>Completed</span>";
                    default:
                        return "<span class='badge bg-secondary'>Unknown</span>";
                }
            })
            ->addColumn('payment_method', function ($query) {
                return $query->payment_method;
            })
            ->rawColumns(['order_status', 'payment_status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Orders $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('status', 'delivered')
            ->with(['user.userAddress']);
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
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
            Column::computed('DT_RowIndex')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center')
            ->title('STT'),
        Column::make('customer_name')->title('Tên khách hàng')->width('17%'),
            Column::make('date')->title('Ngày đặt hàng'),
            Column::make('amount')->title('Tổng tiền'),
            Column::make('order_status')->title('Trạng thái đơn hàng'),
            Column::make('payment_method')->title('Phương thức thanh toán'),
            Column::make('payment_status')->title('Trạng thái thanh toán'),

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
        return 'Order_' . date('YmdHis');
    }
}
