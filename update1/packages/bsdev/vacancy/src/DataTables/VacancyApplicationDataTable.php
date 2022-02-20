<?php

namespace Bsdev\Vacancy\DataTables;

use Bsdev\Vacancy\Models\VacancyApplication;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VacancyApplicationDataTable extends DataTable
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
            ->editColumn('action', function (VacancyApplication $vacancyapplication) {
                return '<a class="" href=' . route('vacancyapplications.edit', $vacancyapplication->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('vacancyapplications.destroy', $vacancyapplication->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('vacancyapplications.destroy', $vacancyapplication->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('vacancy', function (VacancyApplication $vacancyapplication) {
                return $vacancyapplication->vacancy->title;
            })
            ->editColumn('cv', function (VacancyApplication $vacancyapplication) {
                return '<a href="' . asset('storage/' . $vacancyapplication->cv) . '">Click Here</a>';
            })
            ->editColumn('status', function (VacancyApplication $vacancyapplication) {
                return $vacancyapplication->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Approved</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Pending</span>';
            })
            ->escapeColumns([]);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\VacancyApplication $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VacancyApplication $model)
    {
        return $model->orderBy('updated_at', 'DESC')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('vacancyapplication-table')
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
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('cv'),
            Column::make('vacancy')
                ->data('vacancy')
                ->name('vacancy.title'),
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
        return 'VacancyApplication_' . date('YmdHis');
    }
}
