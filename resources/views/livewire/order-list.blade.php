<table class="table-striped">
    <tr>
        <th class="tab-order-no">Order No.</th>
        <th class="tab-order-date">Date</th>
        <th class="tab-order-status">Status</th>
        <th class="tab-order-status">Pyament Status</th>
        <th class="tab-order-status">Shipping</th>
        <th class="ta-order-total">Total</th>
    </tr>
    @forelse ($orders as $order)

    <tr>
        <td>#{{ $order->id }}</td>
        <td>{{ date('M d, Y',strtotime($order->created_at)) }}</td>
        <td>
            @php
            $html = '';
            if ($order->order_status == 1) {
            $html .= '<span
                style="color:white;background-color:yellow; padding:5px; border-radius:10px;">Pending</span>';
            }
            if ($order->order_status == 2) {
            $html .= '<span
                style="color:white;background-color:green; padding:5px; border-radius:10px;">Confirmed</span>';

            }
            if ($order->order_status == 3) {
            $html .= '<span style="color:white;background-color:blue; padding:5px; border-radius:10px;">Picked</span>';

            }
            if ($order->order_status == 4) {
            $html .= '<span
                style="color:white;background-color:#17a2b8; padding:5px; border-radius:10px;">Delivered</span>';

            }
            if ($order->order_status == 5) {
            $html .= '<span
                style="color:white;background-color:red; padding:5px; border-radius:10px;">Cancelled</span>';

            }
            @endphp

            {!! $html !!}

        </td>
        <td>
            @php
            $status = $order->payment_status ? '<span
                style="color:white;background-color:green; padding:5px; border-radius:10px;">Paid</span>' : '<span
                style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpaid</span>';

            @endphp
            {!! $status !!}
        </td>
        <td>
            <b>Shipping:</b>
            @foreach ($order->shipping_detail??[] as $key=>$val)
            <b>{{ $key }}</b>:<i>{{ $val }}</i><br>
            @endforeach
            <b>Shipping Method</b> {{ optional(optional($order->shippingDetail)->shipping_method)->name }}<br>
            <b>Time</b>: Min {{ optional($order->shippingDetail)->time_param_min.'
            '.optional($order->shippingDetail)->time_param }} Max {{ optional($order->shippingDetail)->time_param_max.'
            '.optional($order->shippingDetail)->time_param }}<br>
            <b>Shipping Cost:</b> {{ $order->shipping_cost }}<br>
        </td>

        <td>Rs. {{ ($order->total)+($order->shipping_cost)}} ({{ count($order->cart_items) }} products )

            @foreach ($order->cart_items as $item)
            @php($product = $item->product)
            @if($product)
            @if($product->has_variation)
            {{ $item->variation->title??'Deleted Product' }}<br>
            <ul>
                @foreach ($item->getAttributeArray() as $attribute)
                <li>
                    {{ $attribute->name }}:
                    @php($name =
                    $attribute->values->where('id',$item->variations[$attribute->id])->pluck('name'))
                    <span>{{ $name[0] }}</span>
                </li>
                @endforeach
            </ul>
            @else
            {{ $item->product->title??'Deleted Product' }}<br>
            @endif
            @else  
            Deleted Product
            @endif
            @endforeach


        </td>

    </tr>
    @empty
    <tr>
        <td colspan="5">
            <h5>No Order Yet!!</h5>
        </td>
    </tr>
    @endforelse

</table>