<div class="cart-list-product">
    <div class="cart-product-img">

        <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->title }}">
    </div>
    <div class="cart-product-details">
        <div class="cart-product-name">
            {{ $product->title }}
        </div>
        @if($product->has_variation)
        <div class="cart-product-sub-details">
            <ul>
                @foreach ($item->getAttributeArray() as $attribute)
                <li>
                    {{ $attribute->name }}:
                    @php($name = $attribute->values->where('id',$item->variations[$attribute->id])->pluck('name'))
                    <span>{{ $name[0] }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="cart-product-button">
            {{-- <button class="cart-product-edit">
                Edit
            </button> --}}
            <button wire:click="clickRemove" class="cart-product-del">
                Delete
            </button>
        </div>
    </div>
    <div class="cart-product-qty">
        <form action="">
            <label for="cart-prodcuct-qty-select">Qty:</label>
            <select wire:model="quantity" id="cart-prodcuct-qty-select" name="cart-prodcuct-qty-select"
                form="cart-prodcuct-qty-form">
                @if($product->has_variation)
                @for($i = 1; $i<=$item->variation->quantity;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                    @else
                    @for($i = 1; $i<=$product->quantity;$i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                        @endif
            </select>

        </form>
    </div>
    <div class="cart-product-price">
        @if($product->has_variation)
        @php($price = $item->variation->price)
        Rs. {{ ($price-($price*$product->discount/100))*$quantity }}
        @else
        Rs. {{ $product->discounted_price*$quantity }}

        @endif
    </div>
</div>