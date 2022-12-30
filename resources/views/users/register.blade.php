<x-layout>
    
<div class="form">
    <form method="POST" action="/users" class="create-book">
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
            <label for="email">E-mail: </label>
            <input type="text" name="email" value="{{ old('email') }}" />
            @error('email')
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
            <label for="password_confirmation">Potwierdź Hasło: </label>
            <input type="password" name="password_confirmation" />
            @error('password_confirmation')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-field">
            <label for="birth_date">Data Urodzenia: </label>
            <input type="date" name="birth_date" value="{{ old('birth_date') }}" />
            @error('birth_date')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-field">
            <input type="submit" value="Rejestracja" name="create" />
        </div>
        </div>
    </form>
</div>

</x-layout>