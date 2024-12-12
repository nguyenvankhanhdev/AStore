<?php

namespace App\DataTables;

use App\Models\UserCoupons;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserCouponsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('discount', function ($query) {
                if ($query->coupons->discount_type == 'percent') {
                    return $query->coupons->discount . '%';
                } else {
                    return number_format($query->coupons->discount * 1000, 0, ',', '.') . 'đ';
                }
            })
            ->addColumn('code', function ($query) {
                return $query->coupons->code;
            })
            ->addColumn('quantity', function ($query) {
                return $query->quantity;
            })
            ->addColumn('start_date', function ($query) {
                return date('d-m-Y', strtotime($query->coupons->start_date));
            })
            ->addColumn('end_date', function ($query) {
                return date('d-m-Y', strtotime($query->coupons->end_date));
            })
            ->addColumn('empty_column', function ($query) {
                return ''; // Không có nội dung trong cột
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(UserCoupons $model): QueryBuilder
    {
        $userId = auth()->id();

        // Nếu không có người dùng đăng nhập, trả về truy vấn trống
        if (!$userId) {
            return $model->newQuery()->whereRaw('1=0');
        }

        // Truy vấn UserCoupons của người dùng hiện tại
        return $model->newQuery()
            ->with(['coupons', 'user'])
            ->where('user_id', $userId);
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('usercoupons-table')
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
                'scrollX' => true,
                'responsive' => true, // Hỗ trợ responsive đầy đủ


            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('unique_code')->title('Tên mã giảm giá')->width('25%'),
            Column::make('discount')->title('Giá trị voucher cho đơn hàng')->width('25%'),
            Column::make('start_date')->title('Ngày bắt đầu')->width('25%'),
            Column::make('end_date')->title('Ngày kết thúc')->width('25%'),
            Column::make('empty_column') // Cột trống
                ->title('')  // Không hiển thị tiêu đề
                ->orderable(false) // Không thể sắp xếp
                ->searchable(false) // Không thể tìm kiếm
                ->className('empty-column'), // CSS class nếu cầnf
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UserCoupons_' . date('YmdHis');
    }
}
