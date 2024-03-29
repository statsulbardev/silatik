@section('title', 'Login')

<div>
    <form wire:submit.prevent="login" class="needs-validation">
        {{-- Username Input --}}
        <div class="form-group">
            <label for="username">username</label>
            <input wire:model.defer="username" type="text" class="form-control" tabindex="1" required autofocus>
            @error('username')
                <div class="mt-2">
                    @include('components.notifications.error-field', [
                        'model' => 'username',
                        'pesan' => 'username minimal 3 karakter.'
                    ])
                </div>
            @enderror
        </div>
        {{-- Password Input --}}
        <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <input wire:model.defer="password" type="password" class="form-control" tabindex="2" required>
            @error('password')
                <div class="mt-2">
                    @include('components.notifications.error-field', [
                        'model' => 'password',
                        'pesan' => 'password minimal 5 karakter.'
                    ])
                </div>
            @enderror
        </div>
        {{-- Login Button --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">Login</button>
        </div>
    </form>
</div>
