@component('mail::message')

Dear {{ $user->name }},

Your bid in the David Weber First Readers List auction has been beaten!

@component('mail::button', ['url' => route('home'), 'color' => 'green'])
Bid Again!
@endcomponent


Thank You,<br>
{{ config('app.name', 'Laravel') }} Team
@endcomponent