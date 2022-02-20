@extends('frontend.layouts.master')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@php($site = Theme::siteSetup())
<div class="bg-light-2 pt-6 pb-5 mb-6 mb-lg-8">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-3 mb-lg-0">
                <h2 class="title">Welcome to Mehwool</h2><!-- End .title -->
                <p class="lead text-primary mb-3">who we are?</p><!-- End .lead text-primary -->
                <p class="mb-2">{{$site->introduction}}</p>
                <p class="mb-2">{{$site->phone}}</p>
                <p class="mb-2">{{$site->email}}</p>

            </div><!-- End .col-lg-5 -->

            <div class="col-lg-6 offset-lg-1">
                <div class="about-images">
                  
                 
                    <img src="{{ asset('storage/'.$site->logo) }}" alt="" class="about-img-front">
                    <img src="https://www.thecreativefolk.com/wp-content/uploads/2021/03/Acrylic-Vs-Wool-%E2%80%93-Whats-The-Difference.jpg" alt="" class="about-img-back">
                </div><!-- End .about-images -->
            </div><!-- End .col-lg-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .bg-light-2 pt-6 pb-6 -->

<main style="background: white">
    <!-- Ui cards -->
    <section id="cards">
        <div class="container py-2">
            <div class="row pb-4">
                <div class="col-12 text-center">
                    <div class="display-3">Our Team</div>
                </div>
            </div>
            <!-- cards -->
            <div class="row" style="align-items: center; justify-content:center" >

                @foreach ($teams-> take(1) as $team1)
          
                <div class="col-lg-4 col-md-6 mb-4 pt-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="user-picture">
                                <img src="{{asset('storage/'.$team1->image)}}" class="shadow-sm rounded-circle" height="130" width="130" />
                            </div>
                            <div class="user-content">
                                <h5 class="text-capitalize user-name">{{($team1->name)}}</h5>
                                <p class=" text-capitalize text-muted small blockquote-footer">{{$team1->designation->name}}</p>
                                <p class="small text-muted mb-0">{{$team1->email}}</p>
                                <p class="small text-muted mb-0">{{$team1->phone}}</p>
                                <br>
                                <strong>{!!$team1->introduction!!}</strong>
                                
                                <br>
                                <br>
                                <div style="display: flex; gap:30px">
                                    <center>
                                        <a href="{{$team1->facebook}}"> 
                                        <i style="font-size: 25px" class="fab fa-facebook-f">
                                        </i></a>
                                    </center>
                                    <center>
                                        <a href="{{$team1->twitter}}"> 
                                        <i style="font-size: 25px" class="fab fa-twitter">
                                            </i><a>
                                    </center>
                                    <center>
                                       
                                        <a href="{{$team1->instagram}}"> 
                                            <i style="font-size: 25px" class="fa fa-instagram" aria-hidden="true"></i>
                                      <a>
                                    </center>
                                    <center>
                                        <a href="{{$team1->youtube}}"> 
                                        <i style="font-size: 25px" class="fab fa-youtube">
                                        </i><a>
                                    </center>
                                    <center>
                                        <a href="{{$team1->website}}"> 
                                        <i style="font-size: 25px" class="fa fa-globe">
                                           </i><a>
                                    </center>

                                    
                                </div>
                             
                            </div>
                        </div>
                    </div>
                    
                </div>
                @endforeach
               
               
            </div>

            
       
            <div class="row" style="align-items: center; justify-content:center" >
                @foreach ($teams-> skip(1) as $team1)
                <div class="col-lg-4 col-md-6 mb-4 pt-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="user-picture">
                                <img src="{{asset('storage/'.$team1->image)}}" class="shadow-sm rounded-circle" height="130" width="130" />
                            </div>
                            <div class="user-content">
                                <h5 class="text-capitalize user-name">{{($team1->name)}}</h5>
                                <p class=" text-capitalize text-muted small blockquote-footer">{{$team1->designation->name}}</p>
                                <p class="small text-muted mb-0">{{$team1->email}}</p>
                                <p class="small text-muted mb-0">{{$team1->phone}}</p>
                                <br>
                                <strong>{!!$team1->introduction!!}</strong>
                                
                                <br>
                                <br>
                                <div style="display: flex; gap:25px">
                                    <center>
                                        <a href="{{$team1->facebook}}"> 
                                        <i style="font-size: 25px" class="fab fa-facebook-f">
                                        </i></a>
                                    </center>
                                    <center>
                                        <a href="{{$team1->twitter}}"> 
                                        <i style="font-size: 25px" class="fab fa-twitter">
                                            </i><a>
                                    </center>
                                    <center>
                                       
                                        <a href="{{$team1->instagram}}"> 
                                            <i style="font-size: 25px" class="fa fa-instagram" aria-hidden="true"></i>
                                      <a>
                                    </center>
                                    <center>
                                        <a href="{{$team1->youtube}}"> 
                                        <i style="font-size: 25px" class="fab fa-youtube">
                                        </i><a>
                                    </center>
                                    <center>
                                        <a href="{{$team1->website}}"> 
                                        <i style="font-size: 25px" class="fa fa-globe">
                                           </i><a>
                                    </center>

                                    
                                </div>
                             
                            </div>
                        </div>
                    </div>
                    
                </div>
                @endforeach
             
               
            </div>

        </div>
        <!-- /cards -->
    </section>
    <!-- /Ui cards -->
</main>


@endsection