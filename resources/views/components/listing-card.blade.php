@props(['listing'])

<div class="book-info">
    <h2 class="book-item-title">{{ $listing->title }}</h2>
    <p class="book-item-author">
        {{ DB::table('authors')->whereRaw("id_author =  '$listing->author'")->value('author_name') }}
        {{ DB::table('authors')->whereRaw("id_author =  '$listing->author'")->value('author_surname') }}</p>
    <p class="book-item-publisher">
        {{ DB::table('publishers')->whereRaw("id_publisher =  '$listing->publisher_id'")->value('publisher_name') }}</p>
    <p class="book-item-cathegory">
        {{ DB::table('cathegories')->whereRaw("id_cathegory =  '$listing->cathegory_id'")->value('cathegory_name') }}
    </p>
    <p class="book-item-age">Minimalny wiek {{ $listing->age_to_rent }}</p>
</div>
<div class="book-image">
    <div class="book-image-container">
        <img src="/images/default-book.png" alt="Default book" class="book-img">
    </div>
</div>
