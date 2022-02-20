<?php

namespace Bsdev\Slider\DataTables;

use Bsdev\Slider\Models\Slider;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SlidersDataTable extends DataTable
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
            ->eloquent($query)
            ->editColumn('action', function (Slider $slider) {
                return '<a class="" href=' . route('sliders.edit', $slider->id) . '><i class="fa fa-edit"></i></a><form style="display:inline; margin-left:10px" method="POST" action="' . route('sliders.destroy', $slider->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('sliders.destroy', $slider->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('image', function (Slider $slider) {
                return '<img src=' . asset('storage/' . $slider->image) . ' height="100px">';
            })
            ->editColumn('status', function (Slider $slider) {
                return $slider->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->editColumn('link', function (Slider $slider) {
                return $slider->link ? '<a href="' . $slider->link . '"style="color:white;background-color:blue; padding:5px; border-radius:5px;">Link</a>' : '';
            })
            ->editColumn('user', function (Slider $slider) {
                return $slider->user->name ?? '';
            })
            ->escapeColumns([]);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model)
    {
        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
            return $model->newQuery();
        }
        return $model->vendor()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('sliders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons([
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('title'),
            Column::make('image'),
            Column::make('position'),
            Column::make('link'),
            Column::make('status'),
            Column::make('user')
                ->data('user')
                ->name('user.name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sliders_' . date('YmdHis');
    }
}
