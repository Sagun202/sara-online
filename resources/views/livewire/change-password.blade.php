<form wire:submit.prevent="save">
    <div class="form-group">
        <label for="SecurityDetailsOldPwd">Old Password</label>
        <input type="password" wire:model.defer="old_password" class="form-control" id="SecurityDetailsOldPwd"
            placeholder="Old Password">
        @error('old_password')
        <span style="color: red; font-size:smaller;">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="SecurityDetailsNewPwd">New Password</label>
        <input type="password" wire:model.defer="new_password" class="form-control" id="SecurityDetailsNewPwd"
            placeholder="New Password">
        @error('new_password')
        <span style="color: red; font-size:smaller;">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="SecurityDetailsRePwd">Confirm Password</label>
        <input type="password" wire:model.defer="confirm_password" class="form-control" id="SecurityDetailsRePwd"
            placeholder="Re-Type Password">
        @error('confirm_password')
        <span style="color: red; font-size:smaller;">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" style="background-color: #000066;" class="SecurityDetailsPwdChangeBtn">Change Password <i
            class="fas fa-cog"></i></button>
</form>