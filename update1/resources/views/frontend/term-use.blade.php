@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="breadcrumbs">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li class="home"> <a title="Go to Home Page"
                            href="{{ route('index') }}">Home</a><span>&raquo;</span></li>
                    <li><strong>{{ $content->title }}</strong></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="document-box">
        <div class="document-box-heading">
            <h4>{{ $content->title }}</h4>
            <p>Last Update: <span> {{ date('d/m/Y',strtotime($content->updated_at)) }}</span></p>
        </div>
        <div class="document-box-body">
            {!! $content->description !!}
        </div>
    </div>
</div>
@endsection