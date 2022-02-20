<div class="account-tab-content">
    <div style="display: flex;     justify-content: space-between;">
        <div class="account-tab-content-heading title 

">
            Personal Details
        </div>
        <div class="modal-edit-button">
            <button class="btn-primary" type="button" data-toggle="modal" data-target="#PersonalDetailsModal">
                <i class="far fa-edit" ></i>
            </button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="PersonalDetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="demoModal" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


                <div class="modal-body">
                    <form class="px-sm-4 py-sm-4" wire:submit.prevent="save">
                        <h3>Personal Details</h3>
                        <hr />
                        <div class="form-group">

                            <label for="PersonalDetailsModalName">Full Name</label>
                            <input type="text" class="form-control" wire:model="name" id="PersonalDetailsModalName"
                                aria-describedby="textHelp" placeholder="Enter the name you want to change to">
                            @error('name')
                            <span style="color: red; font-size:smaller;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <label for="email">E-mail</label>
                            <input type="email" wire:model="email" class="form-control" id="email"
                                aria-describedby="textHelp" placeholder="Enter the email you want to change">
                            @error('email')
                            <span style="color: red; font-size:smaller;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <label for="phone">Phone</label>
                            <input type="text" wire:model="phone" class="form-control" id="phone"
                                aria-describedby="textHelp" placeholder="Enter the phone you want to change">
                            @error('phone')
                            <span style="color: red; font-size:smaller;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <label for="image">Image</label>
                            <input type="file" wire:model="image" class="form-control" id="phone"
                                aria-describedby="textHelp" placeholder="Enter the phone you want to change">
                            @if($image)
                            <img src="{{ $image }}" height="100px">
                            @endif
                            @error('image')
                            <span style="color: red; font-size:smaller;">{{ $message }}</span>
                            @enderror
                        </div>
                        <h3>Address Details</h3>
                        <hr />
                        <div class="form-group">

                            <label for="PersonalDetailsModalDistrict">District</label>
                            <input type="text" wire:model="district" class="form-control"
                                id="PersonalDetailsModalDistrict" aria-describedby="textHelp"
                                placeholder="Enter District">
                            @error('district')
                            <span style="color: red; font-size:smaller;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <label for="area">Area</label>
                            <input type="text" wire:model="area" class="form-control" id="area"
                                aria-describedby="textHelp" placeholder="Enter Municipality">
                            @error('area')
                            <span style="color: red; font-size:smaller;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="col-6 form-group">

                                <label for="land_makr">Land Mark</label>
                                <input type="text" wire:model="landmark" class="form-control" id="land_makr"
                                    aria-describedby="textHelp" placeholder="Enter Tol name">
                                @error('landmark')
                                <span style="color: red; font-size:smaller;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="account-modal-change-btn">Submit</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
    <!-- Modal Ends -->   <br>
    <hr  style="width:100%; margin:0 ">



 
    <div class="account-tab-content-text">
<br>

        <li class="list-group-item "><tr>
          
            <p class="widget-title

">  Name : &nbsp;{{ $name }}</p>
       </li>
      
       <li class="list-group-item "><tr>
          
        <p class="widget-title

">  Date joined : &nbsp;{{ date('Y-m-d',strtotime(auth()->user()->created_at)) }}</p>
        </li>
  
        <li class="list-group-item "><tr>
          
            <p class="widget-title

">  Address 1 : &nbsp;{{ $district }}, {{ $area }}, {{ $landmark }}</p>
       </li>
       <li class="list-group-item "><tr>
          
        <p class="widget-title

">  Address 2 : &nbsp;{{ $address }}, {{ $address2 }}, {{ $landmark }}</p>
   </li>
 
      
            
            
          
    
    </div>
</div>