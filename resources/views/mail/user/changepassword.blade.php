@component('mail::message')
# Hello!

You are receiving this email because we successfully changed the password of a user named ** {{ $user->name_full }} ** in {{ config('app.name') }}.
Click Check updates to verify the updated information.
@component('mail::button', ['url' => $url])
Check updates
@endcomponent

Thanks,<br>
{{ config('app.name') }}

If you’re having trouble clicking the "Check updates" button, copy and paste the URL below
into your web browser: [{{ $url }}]({{ $url }})

@endcomponent
