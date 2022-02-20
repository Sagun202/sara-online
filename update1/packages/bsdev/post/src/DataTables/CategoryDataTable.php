<?php

namespace Bsdev\Post\DataTables;

use Bsdev\Post\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent(Category::with('type'))
            ->editColumn('action', function (Category $category) {
                return '<a class="" href=' . route('categories.edit', $category->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('categories.destroy', $category->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('categories.destroy', $category->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('image', function (Category $category) {
                return '<img src=' . asset('storage/' . $category->image) . ' height="100px">';
            })
            ->editColumn('type', function (Category $category) {
                return $category->type->name ?? '';
            })
            ->editColumn('status', function (Category $category) {
                return $category->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('category-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->searchable(false),
            Column::make('name'),
            Column::make('type')
                ->data('type')
                ->name('type.name'),
            Column::make('image'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
