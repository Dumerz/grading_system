@component('mail::message')
# Hello!

You are receiving this email because we successfully deleted a user named ** {{ $user->name_full }} ** in {{ config('app.name') }}.

No further action is required.

Thanks,<br>
{{ config('app.name') }}

@endcomponent
