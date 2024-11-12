<?php

namespace App\DataTables;

use App\Models\Orders;
use App\Models\UserOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class UserOrderDataTable extends DataTable
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
                $showBtn = "<a href='" . route('user.order.show', $query->id) . "' class='btn btn-primary'><i class='far fa-eye'></i></a>";
                return $showBtn;
            })
            ->addColumn('name', function ($query) {
                return $query->users->name;
            })
            ->editColumn('total_amount', function ($query) {
                return number_format($query->total_amount, 0, ',', '.');
            })
            ->addColumn('order_date', function ($query) {
                return date('d-m-Y', strtotime($query->created_at));
            })
            ->addColumn('payment_method', function ($query) {
                return $query->payment_method;
            })
            ->addColumn('status', function ($query) {
                switch ($query->status) {
                    case 'pending':
                        return "<span class='badge bg-warning'>pending</span>";
                        break;
                    case 'processed_and_ready_to_ship':
                        return "<span class='badge bg-info'>processed</span>";
                        break;
                    case 'dropped_off':
                        return "<span class='badge bg-info'>dropped off</span>";
                        break;
                    case 'shipped':
                        return "<span class='badge bg-info'>shipped</span>";
                        break;
                    case 'out_for_delivery':
                        return "<span class='badge bg-primary'>out for delivery</span>";
                        break;
                    case 'delivered':
                        return "<span class='badge bg-success'>delivered</span>";
                        break;
                    case 'canceled':
                        return "<span class='badge bg-danger'>canceled</span>";
                        break;
                    default:
                        break;
                }
            })
            ->rawColumns(['status', 'action', 'payment_method'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Orders $model): QueryBuilder
    {
        return $model->where('user_id', Auth::id())->newQuery();

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
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
            Column::make('name')->title('Tên khách hàng'),
            Column::make('total_amount')->title('Tổng tiền'),
            Column::make('status')->title('Trạng thái'),
            Column::make('order_date')->title('Ngày đặt hàng'),
            Column::make('payment_method')->title('Phương thức thanh toán'),
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
}
