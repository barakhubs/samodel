<div>
    <div class="card d-flex justify-content-center align-items-center">
        <div class="col-8 p-5">
            <h4>Generate strong random password</h4>
            <p>With this tool, you can generate a very strong random password you can use!</p>
            <hr class="mb-5">
            <div class="form-inline">
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" id="password" class="form-control" value="{{ $feedback }}" wire:model="password">
                    </div>
                    <div class="col-md-4">
                        <button id="copy-password" class="btn btn-primary">Copy Password</button>
                    </div>
                </div>
            </div>
            <div class="justify-content-center align-items-center">
                <button class="btn btn-primary" wire:click = "generatePassword">Generate password</button>
            </div>
            <div>
               <br>
               <p>Check our password strength checker too <a href="{{ route('password-checker') }}">here</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('#copy-password').addEventListener('click', function(event) {
    event.preventDefault();
    var passwordField = document.querySelector('#password');
    passwordField.select();
    document.execCommand('copy');
    this.textContent = 'Password Copied';
});
</script>
