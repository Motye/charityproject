@component('mail::message')

Dear {{ $user->name }},

{{ config('bids.outbid-msg') }}

@component('mail::button', ['url' => route('home'), 'color' => 'green'])
Bid Again!
@endcomponent


Thank You,<br>
{{ config('app.name', 'Laravel') }} Team
@endcomponent