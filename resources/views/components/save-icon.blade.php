@props(['saved'])
@if(!$saved)
    <ion-icon class="text-blue-700" name="bookmark-outline"></ion-icon>
@else
    <ion-icon class="text-blue-700" name="bookmark"></ion-icon>
@endif
