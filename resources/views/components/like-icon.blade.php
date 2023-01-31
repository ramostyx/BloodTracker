@props(['liked','id'])
@if(!$liked)
    <a href="#" data-id="{{ $id }}"
       class="like">
        <ion-icon class="text-blue-700" name="heart-outline"></ion-icon>
    </a>
@else
    <a href="#" data-id="{{ $id }}"
       class="unlike">
        <ion-icon class="text-blue-700" name="heart"></ion-icon>
    </a>
@endif
