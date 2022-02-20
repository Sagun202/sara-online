<li class="hidden-xs">
    @auth
    Hi!, {{ \Illuminate\Support\Str::limit(auth()->user()->name,10,'...') }}
    @else
    <a title="Help Center" href="#" data-toggle="modal"
        data-target="#login-register-modal"><span>Login/Register</span></a>

    @endauth

    <div class="modal fade" wire:ignore.self id="login-register-modal" tabindex="-1" role="dialog"
        aria-labelledby="demoModal" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="login-regster-modal-logo ">
                    <img src="" alt="" />
                </div>
                <div class="modal-body">
                    <form class="px-sm-4 py-sm-4 login-modal-form" wire:submit.prevent="login">
                        <div class="form-group">
                            <label for="login-modal-username">Email</label>
                            <input type="text" wire:model.defer="email" class="form-control" id="login-modal-username"
                                aria-describedby="textHelp" placeholder="Enter Email" />
                        </div>

                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="form-group">
                            <label for="login-modal-password">Password</label>
                            <input type="password" wire:model.defer="password" class="form-control"
                                id="login-modal-username" aria-describedby="emailHelp"
                                placeholder="Enter your password" />

                        </div>
                        @error('password')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="login-form-modal-openRegister">
                            <button type="submit" class="btn btn-cstm-danger btn-cta btn-block">
                                Login
                            </button>
                            <p id="acc-register" class="form-text text-muted">
                                Dont have an account?
                            </p>
                            <a class="register-form-open">
                                Register Your account
                            </a>
                        </div>
                    </form>
                    @livewire('register',['currentRouteName'=>url()->current()])
                </div>
            </div>
        </div>
    </div>
</li>