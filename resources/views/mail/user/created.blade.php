@component('mail::message')
# Hello!

You are receiving this email because we successfully created a user named ** {{ $user->name_full }} ** in {{ config('app.name') }}.
Click Check user to verify the created account.
@component('mail::button', ['url' => $url])
Check user
@endcomponent

Thanks,<br>
{{ config('app.name') }}

If you’re having trouble clicking the "Check user" button, copy and paste the URL below
into your web browser: [{{ $url }}]({{ $url }})

@endcomponent

