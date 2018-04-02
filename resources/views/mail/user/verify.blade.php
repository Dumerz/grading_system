@component('mail::message')
# Hello!

You are receiving this email because we received an account registration request for your email account {{ $user['email'] }}. Click Verify Email to verify your account with {{ config('app.name') }}.

@component('mail::button', ['url' => $url])
Verify Email
@endcomponent

If you did not request an account registration, no further action is required.

Thanks,<br>
{{ config('app.name') }}

If you’re having trouble clicking the "Verify Email" button, copy and paste the URL below
into your web browser: [{{ $url }}]({{ $url }})

@endcomponent
