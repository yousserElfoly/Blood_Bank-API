@component('mail::message')
# Introduction

Reset Password.

@component('mail::button', ['url' => 'http://localhost:8000/api/v1/new-password'])
Reset
@endcomponent

<p>Your Reset Password is : {{$code}}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
