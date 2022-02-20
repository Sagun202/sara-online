<div class="row">
    @if(count($items)>0)
    <div class="col-md-8">
        <div class="cart-page-header">
            <div class="cart-page-header-heads">
                <div class="cart-page-heading">
                    Your Bag
                </div>
                <div class="cart-page-subheading">
                    {{ count($items) }} Item
                </div>
            </div>
            <div class="cart-page-header-links">
                <a href="{{ route('index') }}">Continue Shopping <i class="fas fa-caret-right"></i></a>
            </div>
        </div>
        <hr />
        <div class="cart-page-list">
            @foreach ($items as $item)

            @livewire('cart-item',['item'=>$item],key($item->id))
            <hr />
            @endforeach

        </div>
        <div class="cart-page-checkout-btn">

        </div>
    </div>
    <div class="col-md-4">
        <div class="cart-checkout-box">

            <div class="cart-checkout-heading">
                Order Summary
            </div>
            <div class="cart-checkout-summary">
                <table>
                    @php($total = 0)
                    @foreach ($items as $item)
                    @php($product = $item->product)
                    <tr>
                        <th>
                            <span>{{ $item->quanatiy }}</span> {{ $product->title }}
                        </th>
                        <td>
                            @if($product->has_variation)
                            @php($price = $item->variation->price)
                            @php($total+=($price-($price*$product->discount/100))*$item->quantity)
                            Rs. {{ ($price-($price*$product->discount/100))*$item->quantity }}
                            @else
                            @php($total+=$product->discounted_price*$item->quantity)
                            Rs. {{ $product->discounted_price*$item->quantity }}

                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tr class="cart-checkout-total-row">
                        <th>Total</th>
                        <td>Rs. {{ $total }}</td>
                    </tr>
                </table>
            </div>
            <div class="cart-checkout-link">
                @if(auth()->check())
                <a href="{{ route('checkout') }}">Checkout <i class="fas fa-arrow-right"></i></a>
                @else
                <a data-toggle="modal" data-target="#login-register-modal"> Login<i class="fas fa-arrow-right"></i></a>
                @endif
            </div>
        </div>
    </div>
    @else
    <h3>No Items in Cart !!</h3><a href="{{ route('index') }}">Go To Shopping <i class="fas fa-caret-right"></i></a>
    @endif
</div>