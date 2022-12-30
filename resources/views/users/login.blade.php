<x-layout>
    
    <div class="form">
        <form method="POST" action="/users/authenticate" class="create-book">
            @csrf
            <div class="form-content">
                <div class="form-field">
                <label for="login">Login: </label>
                <input type="text" name="login" value="{{ old('login') }}" />
                @error('login')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field">
                <label for="password">Hasło: </label>
                <input type="password" name="password" />
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field">
                <input type="submit" value="Zaloguj" name="create" />
            </div>
            </div>
        </form>
    </div>
    
    </x-layout>