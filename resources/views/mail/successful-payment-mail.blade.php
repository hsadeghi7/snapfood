@component('mail::message')
# Introduction

Successful Payment.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
Snapfood
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
