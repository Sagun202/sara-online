<div class="col-md-4 sticky">
    <div class="jobs-right">
        <div class="job-right-heading">Apply for Position</div>
        <form wire:submit.prevent="apply">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="job-first-name">Full Name*</label>
                    <input type="text" wire:model="name" class="form-control" id="job-first-name"
                        placeholder="First Name" />
                    @error('name')
                    <span style="color: red; font-size:smaller;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="job-email">Email</label>
                    <input type="email" wire:model="email" class="form-control" id="job-email" placeholder="Email" />
                    @error('email')
                    <span style="color: red; font-size:smaller;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="job-phone">Phone</label>
                    <input type="phone" wire:model="phone" class="form-control" id="job-email" placeholder="Phone" />
                    @error('phone')
                    <span style="color: red; font-size:smaller;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="custom-file">
                        <input type="file" wire:model="cv" class="custom-file-input" id="inputGroupFile02">
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        @error('cv')
                        <span style="color: red; font-size:smaller;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary job-form-button">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>