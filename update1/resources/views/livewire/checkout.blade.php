<div class="row">
    <div class="col-md-8">
        <div class="checkout-products">
            <div class="checkout-products-header">
                <div class="checkout-header-item">
                    {{ count($items) }} ITEMS
                </div>
                <div class="checkout-header-price">
                    PRICE
                </div>
                <div class="checkout-header-quantity">
                    QUANTITY
                </div>
            </div>
            @php($total = 0)
            @foreach ($items as $item)
            @php($product = $item->product)
            <div class="checkout-products-items">
                <div class="checkout-items-img">
                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->title }}">
                </div>
                <div class="checkout-items-details">
                    <div class="checkout-items-name">
                        {{ $product->title }}
                    </div>
                    @if($product->has_variation)
                    <ul class="checkout-items-subdetails">
                        @foreach ($item->getAttributeArray() as $attribute)
                        <li>
                            {{ $attribute->name }}:
                            @php($name =
                            $attribute->values->where('id',$item->variations[$attribute->id])->pluck('name'))
                            <span>{{ $name[0] }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                </div>
                <div class="checkout-items-price">
                    @if($product->has_variation)
                    @php($price = $item->variation->price)
                    @php($total+=($price-($price*$product->discount/100))*$item->quantity)
                    Rs. {{ ($price-($price*$product->discount/100)) }}
                    @else
                    @php($total+=$product->discounted_price*$item->quantity)
                    Rs. {{ $product->discounted_price }}

                    @endif
                </div>
                <div class="checkout-items-quantity">
                    Qty: <span>{{ $item->quantity }}</span>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
    <form class="col-md-4" wire:submit.prevent="checkout">
        <div class="checkout-box">
            <div class="checkout-billing-section">
                <div class="checkout-box-billing">
                    <div class="checkout-billing-header">
                        <div class="checkout-billing-icon">

                            <h4> <i class="fas fa-map-marker-alt"></i> Delivery Details</h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="district">State</label>
                        <select class="form-control" wire:model="state">
                            <option value="">Select State</option>
                            @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @error('state')
                        <span style="color: red; font-size:smaller;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>District</label>
                        <select class="form-control" wire:model="district">
                            <option value="">Select District</option>
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                        @error('district')
                        <span style="color: red; font-size:smaller;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Area</label>
                            <select class="form-control" wire:model="area">
                                <option value="">Select Area</option>
                                @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                            @error('area')
                            <span style="color: red; font-size:smaller;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">

                        <label for="landmark">LandMark</label>
                        <input type="text" wire:model="landmark" class="form-control" id="landmark"
                            aria-describedby="textHelp" placeholder="Enter Land mark">
                        @error('landmark')
                        <span style="color: red; font-size:smaller;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <label for="contact">Contact</label>
                        <input type="text" wire:model="phone" class="form-control" id="contact"
                            aria-describedby="textHelp" placeholder="Enter Contact Number">
                        @error('phone')
                        <span style="color: red; font-size:smaller;">{{ $message }}</span>
                        @enderror
                    </div>
                    @if(count($shippings)>0)

                    <div class="form-group">
                        <label>Select Shipping Method</label>
                    </div>
                    @foreach ($shippings as $ship)
                    <div class="form-group" style="display: flex; align-items:flex-start;">
                        <input type="radio" name="shipping" wire:model="shipping" value="{{ $ship->id }}"
                            id="shipping_{{ $ship->id }}">
                        <label for="shipping_{{ $ship->id }}" style="margin-left:5px; ">
                            <b>{{ $ship->shipping_method->name }} </b>Rs. {{ $ship->cost }}
                            <small>
                                Time({{ $ship->time_param_min }} to {{ $ship->time_param_max }}
                                {{ $ship->time_param }} )</small>
                        </label>

                    </div>
                    @endforeach

                    @endif
                    @if($not_found)
                    <h6 style="color:red;">Sorry!! Currently we cant ship these products in your area.</h6>
                    @endif
                    <div class="form-group">
                        <label for="">Payment Method</label>
                        <div>
                            <input type="radio" wire:model="payment_method" value="cod" id="payment_method">
                            <label for="payment_method">Cash On Delivery</label>
                            @error('payment_method')
                            <span style="color: red; font-size:smaller;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="checkout-box-billing-edit">
                    <a href="{{ route('user.dashboard') }}">Edit</a>
                </div>
            </div>
            <hr>
            <div class="checkout-order-section">
                <div class="checkout-order-heading">
                    Order Summary
                </div>
                <table>
                    <tr>
                        <th>Subtotal ({{ count($items) }} items)</th>
                        <td>Rs {{ $total }}</td>
                    </tr>
                    @if($shipping)
                    @php($total+=$shippingDetail->cost)
                    <tr>
                        <th>Shipping Cost</th>
                        <td>Rs {{ $shippingDetail->cost }}</td>
                    </tr>
                    @endif

                    <tr class="checkout-order-total-row">
                        <th>Total:</th>
                        <td>Rs. {{ $total }}</td>
                    </tr>
                </table>

            </div>
            <button type="submit" class="checkout-box-proceed">
                Proceed to Buy
            </button>
        </div>
    </form>
</div>