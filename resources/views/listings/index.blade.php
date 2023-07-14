<x-layout>
    @include('partials._hero')
    <div class="px-20 my-8 mt-16">
        @include('partials._search')
    </div>
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4 sm:px-20">
        @unless (count($listings) == 0)
            @foreach ($listings as $list)
                <x-listing-card :list="$list" />
            @endforeach
        @endunless
    </div>
    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
</x-layout>
