




        <!--1-->
       
        <div class="cartItem row align-items-start">
             @if($product)
          <div class="col-2">
            <img class="w-100" src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->title }}">
          </div>

         
          <div class="col-4 mb-2">
              <strong>
                    <h6 class="">{{ $product->title }}</h6>
             @if($product->has_variation)
       
         
                @foreach ($item->getAttributeArray() as $attribute)
               
                   <p class="pl-1 mb-0"> {{ $attribute->name }}</p>
                   <p class="pl-1 mb-0"> @php($name = $attribute->values->where('id',$item->variations[$attribute->id])->pluck('name'))</p>
                    <p class="pl-1 mb-0">{{ $name[0] }}</p>
            
                @endforeach
           
        
      
            @endif
              </strong>
            
            
          </div>

          <div class="col-2">
            

                <form action="">
               
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
          <div class="col-2">
            <p id="cartItem1Price">
                <h5>

                    @if ($product->has_variation)
            @php($price = $item->variation->price)
            Rs. {{ ($price - $product->discount) * $quantity }}
        @else
            Rs. {{ $product->discounted_price * $quantity }}
            <br>
             <br>
             WAS {{$product->price}}

        @endif

                </h5>
                   
            </p>
          </div>
          <div class="col-1">
            <button wire:click="clickRemove" class="btn-remove"> Remove <i class="icon-close"></i></button>

          </div>
          
        </div>

        @endif

  





   
