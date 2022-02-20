<?php

namespace Bsdev\Ecommerce\DataTables;

use Bsdev\Ecommerce\Models\CustomField;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomFieldDataTable extends DataTable
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
            ->editColumn('action', function (CustomField $custom_field) {
                return '<a class="" href=' . route('custom-fields.edit', $custom_field->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('custom-fields.destroy', $custom_field->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('custom-fields.destroy', $custom_field->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('categories', function (CustomField $custom_field) {
                $html = '<div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($custom_field->categories as $category) {
                    $html .= '<span style="color:white;background-color:#00c38d; margin:2px; padding:5px; border-radius:10px;">';
                    $html .= $category->name ?? '';
                    $html .= '</span>';
                }
                $html .= '</div>';
                return $html;
            })
            ->editColumn('values', function (CustomField $custom_field) {
                $html = '<div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($custom_field->values ?? [] as $value) {
                    $html .= '<span style="color:white;background-color:#b31111d4; margin:2px; padding:5px; border-radius:10px;">';
                    $html .= $value ?? '';
                    $html .= '</span>';
                }
                $html .= '</div>';
                return $html;
            })

            ->editColumn('status', function (CustomField $custom_field) {
                return $custom_field->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->editColumn('required', function (CustomField $custom_field) {
                return $custom_field->required ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Yes</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">No</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CustomField $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CustomField $model)
    {
        return $model->with('categories')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('customfield-table')
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
            Column::make('title'),
            Column::make('placeholder'),
            Column::make('categories')
                ->data('categories')
                ->name('categories.name'),
            Column::make('values'),
            Column::make('status'),
            Column::make('required'),
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
        return 'CustomField_' . date('YmdHis');
    }
}
