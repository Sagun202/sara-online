@extends('frontend.layouts.master')

@section('content')






<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



	<div class="cart-wrap">
		<div class="container">
	        <div class="row">
			    <div class="col-md-12">
			        <div class="main-heading mb-10">My wishlist</div>
			        <div class="table-wishlist">
				        <table cellpadding="0" cellspacing="0" border="0" width="100%">
				        	<thead>
					        	<tr>
					        		<th >Product Name</th>
					        		<th >Category</th>
					        		<th >Unit Price</th>
					        		<th >discount</th>
					        		<th >Stock Status</th>
					        		<th ></th>
					        		<th ></th>
					        	</tr>
					        </thead>
					        <tbody>
					               @foreach ($lists as $list)
            @php($product = $list->product)
					        	<tr>
					        		<td >
					        			<div class="display-flex align-center">
		                                    <div class="img-product">
		                                        <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="" class="mCS_img_loaded">
		                                    </div>
		                                    <div class="name-product">
		                                      {{ $product->title }}
		                                    </div>
	                                    </div>
	                                </td>
	                                	<td  class="price">{{ $product->categories->first()->name??'' }}</td>
					        		<td  class="price">Rs.{{ $product->price }}</td>
					        		<td class="price">- RS {{ $product->discount }}</td>
					        		
					        				<td ><span class="in-stock-box">
					        				    @if($product->status== 1)
					        				    
					        				    In Stock
					        				    @else
					        				    
					        				    out of stock
					        				    
					        				    @endif
					        				    
					        				    </span></td>
					        	
					        		<td > @livewire('single-add-to-cart',['product'=>$product])</td>
									&nbsp;
					        		<td width="10%" class="text-center">
					        		    
					        		    
					        		    
					        		     <a href="javascript:void(0);" onclick="
                                if(confirm('Are you sure want to remove?')){
                                $('#remove_{{ $list->id }}').submit();
                                }
                                " class="btn btn-danger"><i class="far fa-trash-alt"> </i>
                                    <form method="post" id="remove_{{ $list->id }}"
                                        action="{{ route('user.wishlist.remove',$list->id) }}">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </a>
					        		    
					        		    
					        		  </td>
					        	</tr>
					        	      @endforeach
					        
				        	</tbody>
				        </table>
				    </div>
			    </div>
			</div>
		</div>
	</div>
	<style>
	    .cart-wrap {
	padding: 40px 0;
	font-family: 'Open Sans', sans-serif;
}
.main-heading {
	font-size: 19px;
	margin-bottom: 20px;
}
.table-wishlist table {
    width: 100%;
}
.table-wishlist thead {
    border-bottom: 1px solid #e5e5e5;
    margin-bottom: 5px;
}
.table-wishlist thead tr th {
    padding: 8px 0 18px;
    color: #484848;
    font-size: 18px;
    font-weight: 400;
}
.table-wishlist tr td {
    padding: 25px 0;
    vertical-align: middle;
}
.table-wishlist tr td .img-product {
    width: 72px;
    float: left;
    margin-left: 8px;
    margin-right: 31px;
    line-height: 63px;
}
.table-wishlist tr td .img-product img {
	width: 100%;
}
.table-wishlist tr td .name-product {
    font-size: 18px;
    color: #484848;
    padding-top: 8px;
    line-height: 24px;
    width: 50%;
}
.table-wishlist tr td.price {
    font-weight: 600;
	font-size: 18px
}
.table-wishlist tr td .quanlity {
    position: relative;
}

.total {
	font-size: 24px;
	font-weight: 600;
	color: #8660e9;
}
.display-flex {
	display: flex;
}
.align-center {
	align-items: center;
}
.round-black-btn {
	border-radius: 25px;
    background: #212529;
    color: #fff;
    padding: 5px 20px;
    display: inline-block;
    border: solid 2px #212529; 
    transition: all 0.5s ease-in-out 0s;
    cursor: pointer;
    font-size: 18px;
}
.round-black-btn:hover,
.round-black-btn:focus {
	background: transparent;
	color: #212529;
	text-decoration: none;
}
.mb-10 {
    margin-bottom: 10px !important;
}
.mt-30 {
    margin-top: 30px !important;
}
.d-block {
    display: block;
}
.custom-form label {
    font-size: 18px;
    line-height: 14px;
}
.pretty.p-default {
    margin-bottom: 15px;
}
.pretty input:checked~.state.p-primary-o label:before, 
.pretty.p-toggle .state.p-primary-o label:before {
    border-color: #8660e9;
}
.pretty.p-default:not(.p-fill) input:checked~.state.p-primary-o label:after {
    background-color: #8660e9 !important;
}
.main-heading.border-b {
    border-bottom: solid 1px #ededed;
    padding-bottom: 15px;
    margin-bottom: 20px !important;
}
.custom-form .pretty .state label {
    padding-left: 6px;
}
.custom-form .pretty .state label:before {
    top: 1px;
}
.custom-form .pretty .state label:after {
    top: 1px;
}
.custom-form .form-control {
    font-size: 18px;
    height: 38px;
}
.custom-form .form-control:focus {
    box-shadow: none;
}
.custom-form textarea.form-control {
    height: auto;
}
.mt-40 {
    margin-top: 40px !important; 
}
.in-stock-box {
	background: #ff0000;
	font-size: 18px;
	text-align: center;
	border-radius: 25px;
	padding: 4px 15px;
	display: inline-block;  
    color: #fff;
}
.trash-icon {
    font-size: 20px;
    color: #212529;
}
	</style>
@endsection

@push('js')

<script>
    var swiper = new Swiper(".related-swiper-container", {
      slidesPerView: 6,
      spaceBetween: 30,
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
</script>
@endpush