<?php

namespace Bsdev\Post\DataTables;

use Bsdev\Post\Models\Post;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PostDataTable extends DataTable
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
            ->eloquent(Post::with(['categories', 'type']))
            ->editColumn('action', function (Post $post) {
                return '<a class="" href=' . route('posts.edit', $post->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('posts.destroy', $post->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('posts.destroy', $post->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('image', function (Post $post) {
                return '<img src=' . asset('storage/' . $post->image) . ' height="100px">';
            })
            ->editColumn('type', function (Post $post) {
                return $post->type->name ?? '';
            })
            ->editColumn('categories', function (Post $post) {
                $data = '<div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($post->categories as $category) {

                    $data .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $category->name . '</span><br>';
                }

                $data .= '<div>';
                return $data;

            })
            ->editColumn('status', function (Post $post) {
                return $post->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model)
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
            ->setTableId('post-table')
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
            Column::make('title'),
            Column::make('image'),
            Column::make('type')
                ->data('type')
                ->name('type.name'),
            Column::make('categories')
                ->data('categories')
                ->name('categories.name')
                ->sortable(false),
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
        return 'Post_' . date('YmdHis');
    }
}
