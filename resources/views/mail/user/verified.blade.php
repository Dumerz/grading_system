@component('mail::message')
# Welcome!

You are receiving this email because an email account verification request for your email account {{ $user['email'] }} was successfully completed.

Click Login to start your access to {{ config('app.name') }}.

@component('mail::button', ['url' => config('app.url')])
Login
@endcomponent

No further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
