<?php

namespace App\DataTables;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PendingOrderDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $showBtn = "<a href='" . route('admin.orders.show', $query->id) . "' class='btn btn-primary'><i class='far fa-eye'></i></a>";
                // $deleteBtn = "<button data-id='" . $query->id . "' class='btn btn-danger ml-2 mr-2 delete-item'><i class='far fa-trash-alt'></i></button>";

                // return $showBtn . $deleteBtn;
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
                    case 'pending':
                        return "<span class='badge bg-warning'>Pending</span>";
                    case 'delivered':
                        return "<span class='badge bg-success'>Delivered</span>";
                    case 'processed':
                        return "<span class='badge bg-info'>Processed</span>";
                    case 'canceled':
                        return "<span class='badge bg-danger'>Canceled</span>";
                    case 'completed':
                        return "<span class='badge' style='background-color: #28a745; color: white;'>Completed</span>";
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

    public function query(Orders $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('status', 'pending')
            ->with(['user.userAddress']);
    }

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
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('customer_name')->title('Tên khách hàng'),
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

    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
