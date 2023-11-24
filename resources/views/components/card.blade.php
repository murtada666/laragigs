{{-- When using the merge make sure to not override the default attributes otherwise it will not work as needed!!! --}}

{{-- In this way the div tag will be adjsutable when calling it --}}
<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}>

    {{-- Since div tags needs a closing tag we need to add a slot to put whatever we want inside the div --}}
    {{$slot}}
</div>
