<x-layout>
    @if ($listing->active)
    <div class="book-item">
        <h2 class="book-item-title">Tytuł: {{$listing->title}}</h2>
        <p class="book-item-author">Autor: <a href="/?search={{ DB::table('authors')->whereRaw("id_author =  '$listing->author'")->value('author_name')}}" class = "book-link">{{ DB::table('authors')->whereRaw("id_author =  '$listing->author'")->value('author_name')}}  {{ DB::table('authors')->whereRaw("id_author =  '$listing->author'")->value('author_surname')}}</a></p>
        <p class="book-item-publisher">Wydawca: <a href="/?search={{ DB::table('publishers')->whereRaw("id_publisher =  '$listing->publisher_id'")->value('publisher_name')}}" class = "book-link">{{ DB::table('publishers')->whereRaw("id_publisher =  '$listing->publisher_id'")->value('publisher_name')}}</a></p> 
        <p class="book-item-cathegory">Kategoria: <a href="/?search={{ DB::table('cathegories')->whereRaw("id_cathegory =  '$listing->cathegory_id'")->value('cathegory_name')}}" class = "book-link">{{ DB::table('cathegories')->whereRaw("id_cathegory =  '$listing->cathegory_id'")->value('cathegory_name')}}</a></p> 
    <p class="book-item-age">Można wypożyczyć od {{ $listing->age_to_rent}} @if ($listing->age_to_rent == 1)roku @else lat
        
    @endif</p> 
    @can('rent-book')
    @if($listing->is_rented == false)
    <div class="buttons">
    <form method="POST" action="/rent">
        @csrf
        <input type="hidden" name="id_book" value="{{ $listing->id_book }}">
        <input type="hidden" name="age_to_rent" value="{{ $listing->age_to_rent }}">
        <button type="submit" class="rent-btn"><i class="fa-solid fa-plus"></i></button>
    </form>
    @else
    <p style="color:red">Obecnie wypożyczona do <b>{{ DB::table('rents')
    ->where('book_id','=',$listing->id_book)
    ->where('rent_state','!=','Zwrócono')
    ->value('return_date') }}</b> </p>
    @endif
    @else
    @auth
    <p style="color:red">Twoje konto zostało zablokowane! </p>
    @else
    <p style="color:red">Zaloguj się aby móc wypożyczyć! </p>
    @endauth
    
    @endcan
    @can('remove-book')
    <form method="POST" action="/removebook">
        @csrf
        <input type="hidden" name="id_book" value="{{ $listing->id_book }}">
        <input type="hidden" name="is_rented" value="{{ $listing->is_rented }}">
        <button type="submit" class="remove-btn"><i class="fa-solid fa-trash"></i></button>
    </form>
    @endcan
</div>
    </div>
    @else
    <p style="color:red">Książka obecnie nie jest aktywna, poszukaj innej w zakładce przeklądaj!</p>
    @endif
</x-layout>
