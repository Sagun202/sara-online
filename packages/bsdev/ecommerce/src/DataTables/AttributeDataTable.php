<?php

namespace Bsdev\Ecommerce\DataTables;

use Bsdev\Ecommerce\Models\Attribute;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AttributeDataTable extends DataTable
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
            ->editColumn('categories', function (Attribute $attribute) {
                $html = '<div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($attribute->categories as $category) {
                    $html .= '<span style="color:white;background-color:#00c38d; margin:2px; padding:5px; border-radius:10px;">';
                    $html .= $category->name ?? '';
                    $html .= '</span>';
                }
                $html .= '</div>';
                return $html;
            })
            ->editColumn('values', function (Attribute $attribute) {
                $html = '<div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($attribute->values ?? [] as $value) {
                    $html .= '<span style="color:white;background-color:#00c38d; margin:2px; padding:5px; border-radius:10px;">';
                    $html .= $value->name ?? '';
                    $html .= '</span>';
                }
                $html .= '</div>';
                return $html;
            })
            ->editColumn('action', function (Attribute $attribute) {
                return '<a class="" href=' . route('attributes.edit', $attribute->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('attributes.destroy', $attribute->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('attributes.destroy', $attribute->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('status', function (Attribute $attribute) {
                return $attribute->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Attribute $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Attribute $model)
    {
        return $model->with('categories', 'values')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('attribute-table')
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
            Column::make('categories')
                ->data('categories')
                ->name('categories.name'),
            Column::make('values')
                ->date('values')
                ->name('values.name'),
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
        return 'Attribute_' . date('YmdHis');
    }
}
