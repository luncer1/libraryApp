<x-layout>
<x-searchbar/>
    <div class="all-books">
    @unless(count($listings) == 0)    
    @foreach ($listings as $listing)
        <x-link :listing="$listing">
            <x-listing-card :listing="$listing" />
        </x-link>
    @endforeach
    @else
    <p>Brak książek!</p>
    @endunless
    </div>

    <div class="pages">
        {{ $listings->links('pagination::bootstrap-4') }}
    </div>
</x-layout>
