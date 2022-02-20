<?php

namespace Bsdev\Ecommerce\DataTables;

use Bsdev\Ecommerce\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            ->editColumn('action', function (Product $product) {
                return '<a class="" href=' . route('products.edit', $product->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('products.destroy', $product->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('products.destroy', $product->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('brand', function (Product $product) {
                if ($product->brand) {

                    $html = '<span style="color:white;background-color:#7500e0e0; margin:2px; padding:5px; border-radius:10px;">';
                    $html .= $product->brand->name ?? '';
                    $html .= '</span>';
                    return $html;
                }
            })
            ->editColumn('categories', function (Product $product) {
                $html = '<div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($product->categories as $category) {
                    $html .= '<span style="color:white;background-color:#00c38d; margin:2px; padding:5px; border-radius:10px;">';
                    $html .= $category->name ?? '';
                    $html .= '</span>';
                }
                $html .= '</div>';
                return $html;
            })
            ->editColumn('thumbnail', function (Product $product) {
                return '<img src=' . asset('storage/' . $product->thumbnail) . ' height="100px" width="100px">';
            })

            ->editColumn('status', function (Product $product) {
                return $product->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->editColumn('vendor', function (Product $product) {
                return $product->vendor->name ?? '';
            })
            ->editColumn('featured', function (Product $product) {
                return $product->featured ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Yes</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">No</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
            return $model->with(['brand', 'categories', 'vendor'])->orderBy('created_at', 'DESC')->newQuery();
        } else {

            return $model->with(['brand', 'categories'])->orderBy('created_at', 'DESC')->where('user_id', auth()->id())->newQuery();
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
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
                // Button::make('import')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $array = [
            Column::make('id'),
            Column::make('title'),
            Column::make('brand')
                ->data('brand')
                ->name('brand.name'),
            Column::make('thumbnail'),
            Column::make('categories')
                ->data('categories')
                ->name('categories.name'),
            Column::make('price'),
            (!auth()->user()->hasRole('vendor')) ? Column::make('vendor')
                ->data('vendor')
                ->nane('vendor.name') : Column::make('cost_price'),
            Column::make('quantity'),
            Column::make('status'),
            Column::make('featured'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
        return $array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
