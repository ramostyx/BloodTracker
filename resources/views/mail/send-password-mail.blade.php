<x-mail::message>

# Account Credentials:
    username:{{$email}}
    password:{{$password}}

make sure to change the password once you log in to your account


<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
