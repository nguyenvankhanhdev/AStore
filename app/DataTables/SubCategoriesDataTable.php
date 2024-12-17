<?php

namespace App\DataTables;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\SubCategories;

class SubCategoriesDataTable extends DataTable
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
        ->addColumn('action', function($query){
            $editBtn = "<a href='".route('admin.sub-categories.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='".route('admin.sub-categories.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

            return $editBtn.$deleteBtn;
        })
        ->addColumn('category', function ($query) {
            return $query->category->name ;
        })
        ->addColumn('name', function ($query) {
            return $query->name;
        })
        ->addColumn('empty_column', function ($query) {
            return ''; // Không có nội dung trong cột
        })
        ->rawColumns(['action','name'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SubCategories $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('subcategories-table')
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::computed('DT_RowIndex')
                ->title('STT')
                ->width("25%")
                ->searchable(false)
                ->orderable(false),
            Column::make('name')->title("Tên danh mục")
                ->width("25%")
                ->searchable(true)
                ->orderable(true),
            Column::make('category')->title("Danh mục cha")
                ->width("25%")
                ->searchable(true)
                ->orderable(true),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width("25%")
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
        return 'SubCategories_' . date('YmdHis');
    }
}
