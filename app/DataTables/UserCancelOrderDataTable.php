<?php

namespace App\DataTables;

use App\Models\Orders;
use App\Models\UserCancelOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserCancelOrderDataTable extends DataTable
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
                $showBtn = "<a  href='" . route('user.order.show', $query->id) . "' class='btn btn-primary'><i class='far fa-eye'></i></a>";
                $cancelBtn = '';
                if ($query->status !== 'delivered' && $query->status !== 'completed' && $query->status !== 'canceled') {
                    $cancelBtn = "
                    <button
                        style='margin-left: 6px;'
                        data-id='" . $query->id . "'
                        class='btn btn-danger cancel-order'
                        data-toggle='modal'
                        data-target='#cancelOrderModal'
                    >
                        Hủy Đơn
                    </button>";
                }

                return $showBtn . $cancelBtn;
            })
            ->addColumn('name', function ($query) {
                return $query->user->name;
            })
            ->editColumn('total_amount', function ($query) {
                return number_format($query->total_amount, 0, ',', '.');
            })
            ->addColumn('order_cancel_date', function ($query) {
                return $query->order_cancel_date;
            })
            ->addColumn('reason', function ($query) {
                return $query->reason;
            })
            ->addColumn('status', function ($query) {
                return $this->getStatusBadge($query->status);
            })
            ->rawColumns(['status', 'action', 'payment_status','reason','order_cancel_date'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Orders $model): QueryBuilder
    {
        return $model->newQuery()
             ->join('order_cancel', 'orders.id', '=', 'order_cancel.order_id')
             ->where('orders.status', 'canceled')
             ->where('orders.user_id', Auth::id())
             ->select('*', 'order_cancel.order_cancel_date');

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('usercancelorder-table')
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
                'autoWidth' => false,
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */public function getColumns(): array
{
    return [
        Column::make('name')->title('Tên khách hàng')->width(200),
        Column::make('total_amount')->title('Tổng tiền')->width(150),
        Column::make('status')->title('Trạng thái')->width(120),
        Column::make('order_cancel_date')->title('Ngày hủy')->width(180),
        Column::make('payment_status')->title('Trạng thái thanh toán')->width(150),
        Column::make('reason')->title('Lý do hủy')->width(200),
        Column::computed('action')->title('Xem chi tiết')
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
        return 'UserOrder_' . date('YmdHis');
    }

    /**
     * Get the badge for payment status.
     */
    private function getPaymentStatusBadge(string $status): string
    {
        switch ($status) {
            case 'pending':
                return "<span class='badge bg-warning'>Đang chờ</span>";
            case 'completed':
                return "<span class='badge bg-success'>Hoàn thành</span>";
            default:
                return '';
        }
    }

    /**
     * Get the badge for order status.
     */
    private function getStatusBadge(string $status): string
    {
        switch ($status) {
            case 'pending':
                return "<span class='badge bg-warning'>Đang chờ</span>";
            case 'delivered':
                return "<span class='badge bg-info'>Đang giao hàng</span>";
            case 'processed':
                return "<span class='badge bg-info'>Đang xử lý</span>";
            case 'completed':
                return "<span class='badge bg-success'>Hoàn thành</span>";
            case 'canceled':
                return "<span class='badge bg-danger'>Đã hủy</span>";
            default:
                return '';
        }
    }
}
