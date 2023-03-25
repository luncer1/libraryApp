@props(['listing'])
<a href="/book/{{ $listing->id_book }}" class="book-item">
    {{ $slot }}
</a>
