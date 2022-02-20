<form wire:ignore.self class="register-modal-form" wire:submit.prevent="register">
    <div class="form-group">
        <label for="register-modal-fullname">Full Name</label>
        <input type="text" class="form-control" wire:model.defer="name" id="register-modal-fullname"
            aria-describedby="textHelp" placeholder="Enter your full name" />
    </div>
    @error('name')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <div class="form-group">
        <label for="register-modal-phone">Phone</label>
        <input type="text" class="form-control" wire:model.defer="phone" id="register-modal-phone"
            aria-describedby="textHelp" placeholder="Enter your phone" />
    </div>
    @error('phone')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <div class="form-group">
        <label for="register-modal-email">Email</label>
        <input type="email" class="form-control" wire:model.defer="email" id="register-modal-email"
            aria-describedby="textHelp" placeholder="Enter your email" />
    </div>
    @error('email')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <div class="form-group">
        <label for="register-modal-password">Password</label>
        <input type="password" class="form-control" wire:model.defer="password" id="register-modal-fullname"
            aria-describedby="textHelp" placeholder="Enter Password" />
    </div>
    @error('password')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <div class="form-group">
        <label for="register-modal-password">Confirm Password</label>
        <input type="password" class="form-control" wire:model.defer="password_confirmation"
            id="register-modal-fullname" aria-describedby="textHelp" placeholder="Enter Password Again" />
    </div>
    @error('password_confirmation')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <div class="login-form-modal-openLogin">
        <button type="submit" class="btn btn-cstm-danger btn-cta btn-block">
            Register
        </button>
        <p id="acc-register" class="form-text text-muted">
            Already a member?
        </p>
        <a class="login-form-open">
            Login into you account
        </a>
    </div>
</form>