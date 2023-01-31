@props([
'Type',
'Types' => [
'A+' => 'A-positive.svg',
'A-' => 'A-negative.svg',
'B+' => 'B-positive.svg',
'B-' => 'B-negative.svg',
'AB+' => 'AB-positive.svg',
'AB-' => 'AB-negative.svg',
'O+' => 'O-positive.svg',
'O-' => 'O-negative.svg',
]
])


<img src="{{asset('/images/'.$Types[$Type])}}"  alt="{{$Type}}"/>
