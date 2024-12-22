@props(['id'])

<div id="{{$id}}" class="fixed bg-black bg-opacity-30 w-full h-full flex items-center justify-center top-0 left-0 ">
    {{$slot}}
</div>
