<?php

namespace App\DataTables;

use App\Models\Rating;
use App\Models\Ratings;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RatingsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('product', function ($query) {
                return "<a href='" . route('product.details', ['slug' => $query->product->slug]) . "' > " . $query->product->name . "</a>";
            })
            ->addColumn('user', function ($query) {
                return $query->user->name;
            })
            ->addColumn('empty_column', function ($query) {
                return ''; // Không có nội dung trong cột
            })
            ->rawColumns(['action', 'product', 'user'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Ratings $model): QueryBuilder
    {
        return $model->newQuery()->with('user', 'product');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('ratings-table')
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
            Column::make('product')->width('25%'),
            Column::make('user')->width('25%'),
            Column::make('point')->width('25%'),
            Column::make('content')->width('25%'),
            Column::make('empty_column') // Cột trống
                ->title('')  // Không hiển thị tiêu đề
                ->orderable(false) // Không thể sắp xếp
                ->searchable(false) // Không thể tìm kiếm
                ->className('empty-column'), // CSS class nếu cần
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Ratings_' . date('YmdHis');
    }
}
