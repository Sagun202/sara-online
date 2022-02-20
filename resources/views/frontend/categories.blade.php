@extends('frontend.layouts.master')

@section('content')
<div class="index-categories">
    <div class="container-fluid">
        <div class="index-categories-heading">
            <p>Explore our categories</p>
        </div>
        @livewire('categories')

    </div>
</div>
@endsection