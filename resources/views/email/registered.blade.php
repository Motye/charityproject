@extends('layouts.app')

@section('content')
<p>Thank you for registering with {{ config('app.name', 'Laravel') }}.  In order to place a bid, you must confirm your
email address by clicking the button below.  If you are unable to click on the button, copy and paste this link into
your web browser:</p>

    <p>{{ route('confirm', $user->_id) }}</p>

    <p class="text-center"><button class="btn btn-lg btn-success" href="{{ route('confirm', $user->_id) }}">Confirm Your Email</button></p>

    <p>Thank You,</p>
    <p>{{ config('app.name', 'Laravel') }} Team</p>
@endsection
