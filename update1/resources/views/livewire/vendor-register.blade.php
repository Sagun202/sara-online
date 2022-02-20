<div class="sell-box-body">
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="sell-box-form-name">Shop Name</label>
            <input type="text" class="form-control" wire:model="name" id="sell-box-form-name"
                placeholder="Enter shop name">
            @error('name')
            <div style="color:red; font-size:smaller;" class="text-left">
                {{ $message }}
            </div>
            @enderror

        </div>
        <div class="form-group">
            <label for="sell-box-form-number">Phone Number</label>
            <input type="text" class="form-control" wire:model="phone" id="sell-box-form-number"
                placeholder="Enter your Number">
            @error('phone')
            <div style="color:red; font-size:smaller;" class="text-left">
                {{ $message }}
            </div>
            @enderror

        </div>
        <div class="form-group">
            <label for="sell-box-form-email">Email address</label>
            <input type="email" class="form-control" wire:model="email" id="sell-box-form-email"
                aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                else.</small>
            @error('email')
            <div style="color:red; font-size:smaller;" class="text-left">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="sell-box-form-pwd">Password</label>
            <input type="password" wire:model="password" class="form-control" id="sell-box-form-name-pwd"
                placeholder="Password">

        </div>
        @error('password')
        <div style="color:red; font-size:smaller;" class="text-left">
            {{ $message }}
        </div>
        @enderror
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>