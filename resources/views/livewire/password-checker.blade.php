<div>
    <div class="card d-flex justify-content-center align-items-center">
        <div class="col-8 p-5">
            <h4>Check password strength</h4>
            <p>Add your password here to check if it's strong enough</p>
            <form class="form-inline" wire:submit.prevent="submit">
                <div class="row">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" placeholder="Password" wire:model="password">
                        <small>Your password is not stored in our database.</small>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Check Strength</button>
                    </div>
                </div>
            </form>
            <div>
               {!! $feedback !!}
               <br>
               <p>Check our password generator too <a href="{{ route('password-generator') }}">here</a></p>
            </div>
        </div>
    </div>
</div>
