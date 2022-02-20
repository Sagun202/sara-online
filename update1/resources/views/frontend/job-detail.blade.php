@extends('frontend.layouts.master')

@section('content')
<div class="index-whitespace">
    <div class="container">
        <div class="jobs-page">
            <div class="row">
                <div class="col-md-8 ">
                    <div class="jobs-left">
                        <div class="job-heading">{{ $job->title }}</div>
                        <div class="job-subheading">
                            <i class="fas fa-users"></i> {{ $job->no_of_opening }} Opening &nbsp;|| &nbsp;
                            <i class="far fa-clock"></i>{{ $job->type }}
                        </div>
                        <hr />
                        {!! $job->description !!}
                    </div>
                </div>
                @livewire('job',['job'=>$job])
            </div>
        </div>
    </div>
</div>

@endsection