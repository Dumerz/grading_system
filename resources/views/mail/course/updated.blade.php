@component('mail::message')
# Hello!

You are receiving this email because we successfully updated a course named ** {{ $course->name }} ** in {{ config('app.name') }}.
Click Check course to verify the updated course.
@component('mail::button', ['url' => $url])
Check course
@endcomponent

Thanks,<br>
{{ config('app.name') }}

If you’re having trouble clicking the "Check course" button, copy and paste the URL below
into your web browser: [{{ $url }}]({{ $url }})

@endcomponent

