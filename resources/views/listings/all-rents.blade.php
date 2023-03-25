<x-layout>
    @unless(count($rents) == 0)
        <div class="switch-slide">
            <label class="switch">
                <input type="checkbox" checked id="show_done">
                <span class="slider round"></span>
            </label>
            <p>Ukryj zwrócone</p>
        </div>
        <div class="book-info-wrap">
            <table class="book-info-panel">
                <tr class="book-info-panel-row first-row">
                    <td class="book-info-panel-cell">Tytuł</td>
                    <td class="book-info-panel-cell">Login</td>
                    <td class="book-info-panel-cell">Email</td>
                    <td class="book-info-panel-cell">Stan</td>
                    <td class="book-info-panel-cell">Data zwrotu</td>
                    <td class="book-info-panel-cell">Zablokuj</td>
                    <td class="book-info-panel-cell">Zwrot</td>
                    <td class="book-info-panel-cell">Wydaj</td>

                </tr>
                @foreach ($rents as $rent)
                    @csrf
                    <tr class="book-info-panel-row @if ($rent->rent_state == 'Zwrócono') returned @endif">
                        <td class="book-info-panel-cell">
                            {{ DB::table('books')->where('id_book', '=', $rent->book_id)->value('title') }}</td>
                        <td class="book-info-panel-cell">
                            {{ DB::table('users')->where('id_user', '=', $rent->user_id)->value('login') }}</td>
                        <td class="book-info-panel-cell">
                            {{ DB::table('users')->where('id_user', '=', $rent->user_id)->value('email') }}</td>
                        <td class="book-info-panel-cell">{{ $rent->rent_state }}</td>
                        <td class="book-info-panel-cell">{{ $rent->return_date }}</td>
                        <td class="book-info-panel-cell">
                            <form method="POST" action="/blockuser">
                                @csrf
                                <input type="hidden" name="id_book" value="{{ $rent->book_id }}">
                                <input type="hidden" name="id_rent" value="{{ $rent->id_rent }}">
                                <input type="hidden" name="userId" value="{{ $rent->user_id }}">
                                <button type="submit" name="function" class="block" value="block"><i
                                        class="fa-solid fa-ban"></i></button>

                            </form>
                        </td>
                        <td class="book-info-panel-cell">
                            @if ($rent->rent_state != 'Zwrócono')
                                <form method="POST" action="/returnbook">
                                    @csrf
                                    <input type="hidden" name="id_book" value="{{ $rent->book_id }}">
                                    <input type="hidden" name="id_rent" value="{{ $rent->id_rent }}">
                                    <input type="hidden" name="userId" value="{{ $rent->user_id }}">
                                    <button type="submit" class="return"><i class="fa-solid fa-thumbs-up"></i></button>

                                </form>
                            @endif
                        </td>
                        <td class="book-info-panel-cell">
                            @if ($rent->rent_state == 'Oczekuje na odbiór')
                                <form method="POST" action="/givebook">
                                    @csrf
                                    <input type="hidden" name="id_book" value="{{ $rent->book_id }}">
                                    <input type="hidden" name="id_rent" value="{{ $rent->id_rent }}">
                                    <input type="hidden" name="userId" value="{{ $rent->user_id }}">
                                    <button type="submit" class="give"><i
                                            class="fa-solid fa-hand-holding-hand"></i></button>

                                </form>
                            @endif
                        </td>
                @endforeach
            </table>
        </div>
    @else
        Obecnie nikt nic nie wypożycza
    @endunless
    <script src="/js/script.js"></script>
</x-layout>
