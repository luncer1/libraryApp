<x-layout>
    @unless(count($rents) == 0) 
    <div class="switch-slide">
        <label class="switch">
            <input type="checkbox" checked id="show_done">
            <span class="slider round"></span>
        </label>
        <p>Ukryj zwrócone</p>
    </div>
    @foreach ($rents as $rent)
    <div class = "book-info @if($rent->rent_state == "Zwrócono")returned @endif">
        <h2 class="book-item-title">{{DB::table('books')->where('id_book','=',$rent->book_id)->value('title')}}</h2>
        <p class="book-item-author">{{$rent->return_date }}</p>
        <p>Stan: {{ $rent->rent_state }}</p>
        @if($rent->rent_state != "Zwrócono")
        <p class="book-item-author">
            
            @if ($rent->overdue)
            Zwróć jak najszybciej!
            @else
            Jeszcze możesz czytać.
        @endif
       
    </p>
    @endif
    </div>
    

    @endforeach
    @else
    Nie masz nic wypożyczonego zobacz co mamy do zaoferowania w zakładce przeglądaj!
    @endunless
    <script src="/js/script.js"></script>
</x-layout>