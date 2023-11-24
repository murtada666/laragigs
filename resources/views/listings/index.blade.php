{{-- @extends is necessary to bring the layout view --}}
{{-- @extends('layout') --}}

{{-- @section is necessary to determine the code that will be broight to layout view --}}
{{-- @section('content') --}}

<x-layout>
    
@include('partials._hero')
@include('partials._search')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

@unless(count($listings) == 0)

@foreach($listings as $listing)
    {{-- : is to bind the variable --}}
    {{-- Thats how we can access a component: --}}
    <x-listing-card :listing="$listing" />
    
@endforeach
    
@else
    <h2>No Listings Found</h2>    
@endunless

</div>
    {{-- links() is exist only because we used pagination in the controller . --}}
    <div class="mt-6 p-4">
        {{-- SamekeyNameAsInTheController -> links()  --}}
        {{$listings->links()}}
    </div>
</x-layout>
{{-- @endsection --}}