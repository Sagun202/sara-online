@extends('frontend.layouts.master')

@section('content')
<div style="padding-left: 20px; padding-right:20px;">
   
    @livewire('product-list',['products'=>$products,'title'=>$title])

</div>
@endsection