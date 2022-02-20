@extends('frontend.layouts.master')

@section('content')

<div class="container-fluid">
    <div class="account-tab">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#account-tab-account" data-toggle="tab">Account </a></li>
            <li><a href="#account-tab-security" data-toggle="tab">Security</a></li>
            <li><a href="#account-tab-order" data-toggle="tab">Orders</a></li>
        </ul>
    </div>
    <div class="account-content container">
        <div class="col-md-4">
            <div class="account-profile">
                <div class="account-profile-img">
                    <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="">
                </div>
                <div class="account-profile-name">
                    Hello! {{ auth()->user()->name }}
                </div>
            </div>
            <div class="account-contact">
                <div class="account-contact-img">
                    <img src="{{ asset('frontend') }}/images/account-contact.svg" alt="">
                </div>
                <p>Have any confusion or queries?</p>
                <p>Contact Us for quick support!</p>
                <button class="account-button-btn">Contact Us</button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content">
                <div class="tab-pane active" id="account-tab-account">
                    @livewire('personal-detail')
                    <div class="account-tab-content">
                        <div class="account-tab-content-header">
                            <div class="account-tab-content-heading">
                                Contact Details
                            </div>
                            <div class="modal-edit-button">
                                <button type="button" data-toggle="modal" data-target="#PersonalDetailsModal">>
                                    <i class="far fa-edit"></i>
                                </button>
                            </div>
                            <!-- Modal -->

                            <!-- Modal Ends -->
                        </div>
                        <hr />
                        <div class="account-tab-content-text">
                            <table>
                                <tr>
                                    <th>Contact no.</th>
                                    <td>{{ auth()->user()->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ auth()->user()->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="account-tab-security">
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
                <div class="tab-pane" id="account-tab-order">
                    <div class="account-tab-content">
                        <div class="account-tab-content-header-noFlex">
                            <div class="account-tab-content-heading">
                                Order Details
                            </div>
                            <hr>
                           @livewire('order-list')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection