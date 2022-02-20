@extends('frontend.layouts.master')

@section('content')

<br>

<div style="padding: 20px">


<div class="row" style="justify-content: space-around;">
    <div class="col-md-4" style="background: white; margin-left:20px; border-radius:10px;">
        <div class="account-profile text-center" >
            <div class="account-profile-img " style="height: 300px; width:300px;">
                <img style="width: 100%" src="{{ asset('storage/'.auth()->user()->image) }}" alt="" style="margin-left: auto; margin-right:auto">
            </div>
            <div class="account-profile-name">
                Hello! {{ auth()->user()->name }}
            </div>
        </div>
        <div class="account-contact text-center">
            <div class="account-contact-img ">
                <img src="{{ asset('frontend') }}/images/account-contact.svg" alt="">
            </div>
            <p>Have any confusion or queries?</p>
            <p>Contact Us for quick support!</p>
            <button class="account-button-btn">Contact Us</button>
        </div>
    </div>

    <div class="col-7" style="background: white;  border-radius:10px;">
        <br>
        <ul class="nav nav-tabs justify-content-center" id="tabs-4" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab-13-tab" data-toggle="tab" href="#tab-13" role="tab" aria-controls="tab-13" aria-selected="false">Account </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-14-tab" data-toggle="tab" href="#tab-14" role="tab" aria-controls="tab-14" aria-selected="true">Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-15-tab" data-toggle="tab" href="#tab-15" role="tab" aria-controls="tab-15" aria-selected="false">Orders</a>
            </li>
           
        </ul>
        <div class="tab-content tab-content-border" id="tab-content-4">
            <div class="tab-pane fade active show" id="tab-13" role="tabpanel" aria-labelledby="tab-13-tab">
                @livewire('personal-detail')



               


                        <div class="account-tab-content">
                        <br>    
                            <div style="display: flex;     justify-content: space-between;">
                                <div class="account-tab-content-heading title 

">
                                    Contact Details
                                </div>
                                <div class="modal-edit-button">
                                    <button class="btn-primary"  type="button" data-toggle="modal" data-target="#PersonalDetailsModal">
                                        <i class="far fa-edit"></i>
                                    </button>
                                </div>
                            </div>

                            <hr />
                            <div class="account-tab-content-text">

                                <li class="list-group-item "><tr>
          
                                    <p class="widget-title">  Contact no. &nbsp;{{ auth()->user()->phone }}</p>
                               </li>

                               <li class="list-group-item "><tr>
          
                                <p class="widget-title

">  Email. &nbsp;{{ auth()->user()->email }}</p>
                           </li>
                            </div>
                        </div>
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade " id="tab-14" role="tabpanel" aria-labelledby="tab-14-tab">
                <div class="account-tab-content">
                    <div class="account-tab-content-header-noFlex">
                        <div class="account-tab-content-heading">
                            Security Details
                        </div>
                        <hr>
                        <div class="account-tab-content-text">
                            <!-- <table>
                                <tr>
                                    <th>Name</th>
                                    <td>Sanjog Piya</td>
                                </tr>
                                <tr>
                                    <th>Date joined</th>
                                    <td>24th May 2019</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>Baneshwor, Kathmandu</td>
                                </tr>
                            </table> -->
                           @livewire('change-password')
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-15" role="tabpanel" aria-labelledby="tab-15-tab">
                <div class="account-tab-content-header-noFlex">
                    <div class="account-tab-content-heading">
                        Order Details
                    </div>
                    <hr>
                   @livewire('order-list')
    
                </div>
            </div>
          
        </div><!-- End .tab-content -->
    
    </div>
</div>
</div>
<br>
@endsection