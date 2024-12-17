<?php

namespace App\DataTables;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;

class CategoriesDataTable extends DataTable
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
            $editBtn = "<a href='" . route('admin.categories.edit', $query->id) . "' class='btn btn-dark'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='" . route('admin.categories.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
            return $editBtn . $deleteBtn;
        })
        ->addColumn('empty_column', function ($query) {
            return ''; // Không có nội dung trong cột
        })
        ->rawColumns(['action'])
        ->setRowId('id');

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Categories $model): QueryBuilder
    {
        Log::info('Querying categories data');
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('categories-table')
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
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('STT')
                ->width("33%")
                ->searchable(false)
                ->orderable(false),
            Column::make('name')->width("33%")
                ->title('Tên danh mục')
                ->searchable(true)
                ->orderable(true),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width("33%")
                ->addClass('text-center'),
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
        return 'Categories_' . date('YmdHis');
    }
}
