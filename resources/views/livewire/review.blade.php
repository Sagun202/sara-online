<div class="tab-pane " id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
 


    <div class="subscribe">
        <div class="subscribe__form">
          <form action="" class="form" wire:submit.prevent="save">
            <h3>
              
            </h3>
            <div class="form__title">

              <h3>Write Your Own Review</h3>
              <h5>
              You're reviewing: <span>{{ $product->title }}</span></h5>
            </div>


            <div class="form__group">
                <div class="form__radio">
                  <input type="radio" class="form__radio-input" id="one" name="review-star" value="1" wire:model="rate">
                  <label for="one">
                    <span class="form__radio-button"></span>
                    1 star
                  </label>
                </div>
                <div class="form__radio">
                  <input type="radio" class="form__radio-input" id="two" name="review-star" value="2" wire:model="rate">
                  <label for="two">
                    <span class="form__radio-button"></span>
                  2 star
                  </label>
                </div>
                <div class="form__radio">
                    <input type="radio" class="form__radio-input" id="three" name="review-star" value="3" wire:model="rate">
                    <label for="three">
                      <span class="form__radio-button"></span>
                    3 star
                    </label>
                  </div>
                  <div class="form__radio">
                    <input type="radio" class="form__radio-input" id="four" name="review-star" value="4" wire:model="rate">
                    <label for="four">
                      <span class="form__radio-button"></span>
                   4  star
                    </label>
                  </div>
                  <div class="form__radio">
                    <input type="radio" class="form__radio-input" id="five" name="review-star" value="5" wire:model="rate">
                    <label for="five">
                      <span class="form__radio-button"></span>
                    5 star
                    </label>
                  </div>
              </div>
            
         

            <div class="form-element">
                
                <input class="form__input" type="text" wire:model="name" placeholder="Name" /><br>
                @error('name')
                <span style="font-size: smaller; color:red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-element">
                
                <textarea class="form__input" type="text" wire:model="review"  placeholder="review"></textarea><br>
                @error('review')
                <span style="font-size: smaller; color:red;">{{ $message }}</span>
                @enderror
            </div>
          
          
        



      
            <button type="submit" class="btn btn--green">submit</button>
          </form>
        </div>
    </div>
    <br>





    <div class="reviews">
        <div class="container">
            <h3>( {{ count($product->reviews) }} Reviews )</h3>
        
            @forelse ($reviews as $review)
            <div class="review">
                <div class="row no-gutters">
                    <div class="col-auto">
                        <h4><a href="#">{{ $review->name }}</a></h4>
                        <div class="ratings-container">
                            <div>
                                <div >
                                    @for($i=0;$i<$review->rate; $i++)
                                        <i class="fa fa-star" style="color: red"></i>
                                        @endfor
                                        @for($i=0;$i<$review->rate-5;$i++)
                                            <i class="fa fa-star-o" style="color: red"></i>
                                            @endfor
                                </div>
                            </div><!-- End .ratings -->
                        </div><!-- End .rating-container -->
                        <span class="review-date">({{ date('m/d/Y',strtotime($review->created_at)) }})</span>
                    </div><!-- End .col -->
                    <div class="col">
                       

                        <div class="review-content">
                            <p>      {!! $review->review !!}</p>
                        </div><!-- End .review-content -->

                     
                    </div><!-- End .col-auto -->
                </div><!-- End .row -->
            </div><!-- End .review -->
            @empty
        <p>No Reviews Yet!!</p>
        @endforelse
        </div><!-- End .container -->
    </div>







      <style>


 .subscribe {

	 min-width: 600px;
	 height: 400px;
	 padding: 30px;
	 box-shadow: 0.2px 0.2px 6px rgba(0, 0, 0, 0.1);
	 border-radius: 4px;
	 display: flex;
	 flex-direction: row-reverse;
	 background-image: linear-gradient(105deg, transparent 0%, transparent 15%, rgba(255, 255, 255, .75) 15%), url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDxkdrvvC_B7HdSiDxpT_6dJtwFBfWvvVr4w&usqp=CAU);
	 background-size: cover;
	 background-repeat: no-repeat;
	 background-position: left bottom;
}
 @media (min-width: 800px) {
	 .subscribe {
		 background-image: linear-gradient(105deg, transparent 0%, transparent 25%, rgba(255, 255, 255, .75) 25%), url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDxkdrvvC_B7HdSiDxpT_6dJtwFBfWvvVr4w&usqp=CAU);
	}
}
 .subscribe__form {
	 width: 85%;
}
 @media (min-width: 800px) {
	 .subscribe__form {
		 width: calc(75% - 15px);
	}
}
 .form {
	 display: block;
	 margin-left: auto;
	 margin-right: auto;
	 display: flex;
	 height: 100%;
	 flex-direction: column;
	 justify-content: center;
}
 .form__title {
	 color: #f6be39;
	 text-align: center;
}
 .form__group {
	 margin-bottom: 14px;
}
 .form__input {
	 padding: 8px 10px 5px 10px;
	 background-color: rgba(255, 255, 255, 0.5);
	 border: none;
	 border-radius: 2px;
	 font-size: 14px;
	 font-family: inherit;
	 display: block;
	 width: 100%;
	 border-top: 3px solid transparent;
	 border-bottom: 3px solid transparent;
	 transition: all 0.3s ease-in;
}
 .form__input:focus {
	 outline: none;
	 box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
	 border-bottom-color: red;
}
 .form__input:focus:invalid {
	 border-bottom-color: red;
}
 .form__input:focus:valid {
	 border-bottom-color: #2ed199;
}
 .form__input::-webkit-input-placeholder {
	 color: rgba(0, 0, 0, .5);
}
 .form__radio {
	 display: inline-block;
	 margin-bottom: 14px;
}
 .form__radio:not(:last-child) {
	 margin-right: 10px;
}
 .form__radio label {
	 color: rgba(0, 0, 0, 0.5);
	 cursor: pointer;
}
 .form__radio-input {
	 display: none;
}
 .form__radio-button {
	 width: 28px;
	 height: 28px;
	 display: inline-block;
	 border-radius: 50%;
	 border: 3px solid red;
	 vertical-align: middle;
	 position: relative;
}
 .form__radio-button::after {
	 content: '';
	 width: 12px;
	 height: 12px;
	 display: block;
	 background-color: red;
	 border-radius: 50%;
	 position: absolute;
	 top: 50%;
	 left: 50%;
	 transform: translate(-50%, -50%) scale(0);
	 opacity: 0;
	 transition: all 0.3s;
}
 .form__radio-input:hover ~ label .form__radio-button::after {
	 opacity: 1;
	 transform: translate(-50%, -50%) scale(0.6);
}
 .form__radio-input:checked ~ label .form__radio-button::after {
	 opacity: 1;
	 transform: translate(-50%, -50%) scale(1.2);
}
 .btn {
	 display: inline-block;
	 background-color: transparent;
	 border: none;
	 padding: 10px 16px;
	 border-radius: 4px;
	 box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .2);
	 text-transform: uppercase;
	 align-self: center;
	 cursor: pointer;
}
 .btn--green {
	 background-color: #2ed199;
	 color: #fff;
}
 
      </style>



















</div>