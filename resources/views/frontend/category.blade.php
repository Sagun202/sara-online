@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="breadcrumbs">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li class="home"> <a title="Go to Home Page"
                            href="{{ route('index') }}">Home</a><span>&raquo;</span></li>
                    <li><strong>Categories</strong></li>
                </ul>
            </div>
        </div>
    </div>

    @livewire('category',['category'=>$category])

</div>
@endsection