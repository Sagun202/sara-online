<?php

namespace Bsdev\Team\DataTables;

use Bsdev\Team\Models\Designation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DesignationDataTable extends DataTable
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
            ->eloquent(Designation::with('designation'))
            ->editColumn('action', function (Designation $designation) {
                return '<a class="" href=' . route('designations.edit', $designation->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('designations.destroy', $designation->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('designations.destroy', $designation->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('designation', function (Designation $designation) {
                return $designation->designation->name ?? '';
            })
            ->editColumn('status', function (Designation $designation) {
                return $designation->status ? '<span style="color:white;background-color:green; font-size:smaller; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px; font-size:smaller;">Unpublished</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Designation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Designation $model)
    {
        return Designation::with('designation');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('designation-table')
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
            Column::make('designation')
                ->data('designation')
                ->name('designation.name')
                ->searchable(false),
            Column::make('position'),
            Column::make('status'),
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
        return 'Designation_' . date('YmdHis');
    }
}
