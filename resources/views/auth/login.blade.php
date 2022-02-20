

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">




    <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


    <!-- section starts here -->
    <section class="vh-100" style="margin-bottom: 40px;">
        <div class="container" id="contain">
            
          <div class="row d-flex align-items-center justify-content-center h-100">
            
            <!-- col1 -->
            <div class="div1 col-md-8 col-lg-7 col-xl-6" >
                <div class="login1">
                    <img src="{{ asset('storage/'.Theme::siteSetup()->logo) }}" class="img-fluid" alt="Sample image">
                    
            </div>
            </div>

            <!-- col2 -->
            
                 <!-- Session Status -->
    
            <div class="col-md-7 col-lg-5 col-xl-5 "  id="form2" >
                
              <form  method="POST" action="{{ route('login') }}">
                    @csrf
                <!-- Email input -->
                <div class="form1 mb-4" >
                       <x-label for="email" :value="__('Email')" />

                <x-input id="email form1Example13" class="form-control-1 form-control form-control-lg" placeholder="Enter your email" type="email" name="email" :value="old('email')" required
                    autofocus />
                 
                  
                </div>
      
                <!-- Password input -->
                <div class="form1 mb-4">
                    
                        <x-label for="password" :value="__('Password')" />

                <x-input id="password form1Example23" class="form-control-1 form-control form-control-lg" placeholder="Enter your password" type="password" name="password" required
                    autocomplete="current-password" />
 
                </div>
      
                <div class="d-flex justify-content-around align-items-center mb-4">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3"/>
                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                  </div>
                  
                  
                  
                    @if (Route::has('password.request'))
                <a style="color: rgb(184, 40, 40); text-decoration: none;" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
               
                </div>
      
                <!-- Submit button -->
                <button type="submit" class="btn btn-warning btn-lg btn-block w-100">Sign in</button><hr>
      
               
      
              </form>
            </div>
          </div>
        </div>
      </section> 



<style>
    /* .divider:after,
.divider:before {
  content: "";
  flex: 1;
  height: 1px;
  background: #eee;
} */
.login-logo{
    width: auto;
    height: auto;
    text-align: center;
}
/*  */
#contain{
margin-top: 10px; 
margin-bottom: 60px;
padding-top: 10px;
}
.log{
    /* padding-left: 10px; */
    text-decoration: none;
    color: #ffb408;
}
.log:hover{
    color: blue;
}
.registerHere{
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    width: 100%;
    height: 50px;
    margin-bottom: 40px;
    padding: 0.1px;
}
.registerHere a{
    color: #ffb408;
    text-decoration: none;


}
.registerHere a:hover{
    color: rgb(66, 44, 194);
   
}
.form-control-1{
    font-size: 15px;
}
.form-control-1:hover{
    color: black;
}
.divider h6{
    color: rgba(82, 75, 75,0.6);
}
.btn1{
    background-color: #3571e0;
    color: white;
    margin-bottom: 10px;
}
.btn1:hover{
  background-color: rgba(0, 0, 0, 0.6);
    color: white;
}
.btn2{
    background-color: rgb(187, 37, 37);
    color: white;
}
.btn2:hover{
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
}

@media only screen and (max-width: 600px) {
    #form2 {
      margin-left: 0% !important;
      padding-left: 0%;
      margin-top: -54px;act
    }
  
  }

  @media only screen and (max-width: 600px) {
  .div1{
    box-shadow: none;
    margin-bottom: 10px !important;

}
  }

#form2{
box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
 margin-left: 20px; 
 padding-top: 5%; 
 padding: 5%;
margin-top: 27px;
}  

.div1{
 
    margin-top: 65px; 
    margin-bottom: 60px;
}


</style>












































