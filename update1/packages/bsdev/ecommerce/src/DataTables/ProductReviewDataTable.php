<?php

namespace Bsdev\Ecommerce\DataTables;

use Bsdev\Ecommerce\Models\ProductReview;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductReviewDataTable extends DataTable
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
            ->editColumn('action', function (ProductReview $productreview) {
                return '<a class="" href=' . route('productreviews.edit', $productreview->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('productreviews.destroy', $productreview->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('productreviews.destroy', $productreview->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('product', function (ProductReview $productreview) {
                return $productreview->product->title ?? '';
            })
            ->editColumn('status', function (ProductReview $productreview) {
                return $productreview->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductReview $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductReview $model)
    {
        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
            return $model->with('product')->orderBy('updated_at', 'DESC')->newQuery();
        } else {

            return $model->whereHas('product', function ($query) {
                $query->where('user_id', auth()->id());
            })->orderBy('updated_at', 'DESC')->newQuery();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('productreview-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
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
            Column::make('rate'),
            Column::make('review'),
            Column::make('product')
                ->data('product')
                ->name('product.title'),
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
        return 'ProductReview_' . date('YmdHis');
    }
}
