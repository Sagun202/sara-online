@extends('frontend.layouts.master')

@section('content')
<div class="help-center-banner" style="background-image: url('{{ asset('storage/'.$content->image) }}')">
</div>
<div class="help-center-heading">
    <h4>{!! $content->description !!}</h4>
</div>
<div class="container">
    <div class="row help-left-right">
        <div class="col-lg-3 col-md-6">
            <div class="help-left">
                @php($faqs = Theme::getFaq())
                <ul class="nav help-tab-trigger" id="help-page-tab" role="tablist">
                    @foreach ($faqs as $faq)
                    <li class="nav-item">
                        <a class="nav-link {{ ($loop->iteration==1)?'active':'' }}" id="help-{{ $loop->iteration }}-tab"
                            data-toggle="tab" href="#help-{{ $loop->iteration }}" role="tab"
                            aria-controls="help-{{ $loop->iteration }}" aria-selected="true">{{ $faq->question }}</a>
                    </li>

                    @endforeach

                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-6">
            <div class="help-right">
                <div class="tab-content help-tab-content" id="help-page-tab-content">
                    @foreach ($faqs as $faq)
                    <div class="tab-pane fade {{ ($loop->iteration==1)?'in active':'' }}"
                        id="help-{{ $loop->iteration }}" role="tabpanel"
                        aria-labelledby="help-{{ $loop->iteration }}-tab">
                        <div class="help-{{ $loop->iteration }}">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection