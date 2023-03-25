<div class="form">
    <form method="POST" action="/book" class="create-book">
        @csrf
        <div class="form-content">
            <div class="form-field">
                <label for="title">Tytuł: </label>
                <input type="text" name="title" value="{{ old('title') }}" />
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field">
                <label for="author">Autor: </label>
                <input type="text" name="author" value="{{ old('author') }}" />
                @error('author')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field">
                <label for="publisher_id">Wydawca: </label>
                <input type="text" name="publisher_id" value="{{ old('publisher_id') }}" />
                @error('publisher_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field">
                <label for="cathegory_id">Kategoria: </label>
                <input type="text" name="cathegory_id" value="{{ old('cathegory_id') }}" />
                @error('cathegory_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field">
                <label for="ageToRent">Minimalny wiek: </label>
                <input type="text" name="age_to_rent" value="{{ old('age_to_rent') }}" />
                @error('age_to_rent')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field">
                <button type="submit" name="create">Dodaj Książkę <i class="fa-solid fa-book"></i></button>
            </div>
        </div>
    </form>
</div>
