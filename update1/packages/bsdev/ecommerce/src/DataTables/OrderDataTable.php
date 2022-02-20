<?php

namespace Bsdev\Ecommerce\DataTables;

use Bsdev\Ecommerce\Models\Order;
use Bsdev\Ecommerce\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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
            ->editColumn('action', function (Order $order) {
                return '<a class="" href=' . route('orders.edit', $order->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('orders.destroy', $order->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('orders.destroy', $order->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>
                <a class="" href=' . route('invoice', $order->id) . '><i class="fa fa-file"></i></a>';
            })
            ->editColumn('created_at', function (Order $order) {
                return date('Y M d', strtotime($order->created_at));
            })
            ->editColumn('shipping', function (Order $order) {
                $html = '<div>';
                foreach ($order->shipping_detail ?? [] as $key => $val) {
                    $html .= '<b>' . $key . '</b>:<i>' . $val . '</i><br>';
                }
                $html .= '<b>Shipping Method: </b>' . optional(optional($order->shippingDetail)->shipping_method)->name . '<br>';
                $html .= '<b>Delivery</b><span>' . ' min:' . optional($order->shippingDetail)->time_param_min . optional($order->shippingDetail)->time_param . ',max:' . optional($order->shippingDetail)->time_param_max . optional($order->shippingDetail)->time_param . '</span><br>';
                $html .= '<b>Shipping Cost:</b>  ' . $order->shipping_cost;
                $html .= '</div>';
                return $html;
            })
            ->editColumn('payment_status', function (Order $order) {
                return $order->payment_status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Paid</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpaid</span>';
            })
            ->editColumn('order_status', function (Order $order) {
                $html = '';
                if ($order->order_status == 1) {
                    $html .= '<span style="color:white;background-color:yellow; padding:5px; border-radius:10px;">Pending</span>';
                }
                if ($order->order_status == 2) {
                    $html .= '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Confirmed</span>';

                }
                if ($order->order_status == 3) {
                    $html .= '<span style="color:white;background-color:blue; padding:5px; border-radius:10px;">Picked</span>';

                }
                if ($order->order_status == 4) {
                    $html .= '<span style="color:white;background-color:#17a2b8; padding:5px; border-radius:10px;">Delivered</span>';

                }
                if ($order->order_status == 5) {
                    $html .= '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Cancelled</span>';

                }

                return $html;
            })
            ->editColumn('user', function (Order $order) {
                $data = '';
                $data .= $order->user->name . '<br>' . $order->user->phone;
                return $data;
            })
            ->editColumn('cart_items', function (Order $order) {
                $html = '<div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($order->cart_items as $item) {
                    if (auth()->user()->hasRole('vendor')) {

                        if (in_array($item->product_id, $this->getProductIds())) {
                            $html .= '<span style="color:white;background-color:#00c38d; margin:2px; padding:5px; border-radius:10px;">';
                            $html .= '<a class="text-white" href="' . route('products.edit', $item->product_id) . '">' . $item->product->title ?? '';
                            $html .= '</a><br>Quantity:  ' . $item->quantity ?? '';
                            $html .= '</span>';
                        }
                    } else {
                        $html .= '<span style="color:white;background-color:#00c38d; margin:2px; padding:5px; border-radius:10px;">';
                        $html .= $item->product->title ?? '' . 'X' . $item->quanity;
                        $html .= '</span>';
                    }
                }
                $html .= '</div>';
                return $html;
            })
            ->escapeColumns([]);
    }

    public function getProductIds()
    {
        return Product::where('user_id', auth()->id())->pluck('id')->toArray();
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
            return $model->with('user', 'cart_items', 'shippingDetail')->orderBy('created_at', 'DESC')->newQuery();
        }
        return $model->with('user', 'shippingDetail')->whereHas('cart_items', function ($query) {
            $query->whereIn('product_id', $this->getProductIds())->where('cart_id', null);
        }
        )->orderBy('created_at', 'DESC')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('order-table')
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
        if (auth()->user()->hasRole('vendor')) {

            $arr = [
                Column::make('id'),
                // Column::make('total'),
                // Column::make('shipping'),
                // Column::make('payment_status'),
                // Column::make('payment_method'),
                Column::make('order_status'),
                Column::make('cart_items')
                    ->data('cart_items')
                    ->name('cart_items.product')
                    ->searchable(false)
                    ->sortable(false),

                // Column::make('user')
                //     ->data('user')
                //     ->name('user.name'),
                Column::make('created_at'),
                // Column::computed('action')
                //     ->exportable(false)
                //     ->printable(false)
                //     ->width(60)
                //     ->addClass('text-center'),
            ];
        } else {
            $arr = [
                Column::make('id'),
                Column::make('total'),
                Column::make('shipping'),
                Column::make('payment_status'),
                Column::make('payment_method'),
                Column::make('order_status'),
                Column::make('cart_items')
                    ->data('cart_items')
                    ->name('cart_items.product')
                    ->searchable(false)
                    ->sortable(false),

                Column::make('user')
                    ->data('user')
                    ->name('user.name'),
                Column::make('created_at'),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];
        }
        return $arr;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Order_' . date('YmdHis');
    }
}
