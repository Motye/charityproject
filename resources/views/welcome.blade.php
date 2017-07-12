@extends('layouts.app')

@section('content')
    <div>
        <br/>
        @if (session('status'))
            <div class="alert alert-success alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                {{ session('error') }}
            </div>
        @endif

        @if(Auth::check() && Auth::user()->confirmed === true)
            @if(Auth::user()->numberOfBids() === 0)
                <div class="alert alert-success alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    Would you like to <a href="#bid-form">place a bid</a>?
                </div>

            @elseif(Auth::user()->hasHighBid())
                <div class="alert alert-success alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <strong>Congratulations! You currently have the high bid!</strong>
                </div>
            @else
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <strong>You have been out bid! The current high bid is ${{ number_format($high_bid) }}. Would you
                        like to <a href="#bid-form">bid again</a>?</strong>
                </div>

            @endif
        @endif

        <h1 class="text-center text-uppercase">Standing With a Hero</h1>

        <p>Elijah Dimas (HMS Implacable the Sante Fe chapter of The Royal Manticoran Navy, the Official Honor
            Harrington Fan Club) is the RMN's youngest Midshipman. 9 years old, entering 5th grade, Elijah is fond
            of math, science, and especially art. He is an avid fan of science-fiction (especially David Weber's
            Honor Harrington series), Pokémon, and the Oakland Raiders. He loves elephants, ventriloquism, jokes,
            the colors green and yellow, and he particularly enjoys helping other children face their own
            challenges.</p>

        <p>Elijah lives his life according the quote "Live Your Life Fearlessly!"</p>

        <p>How profound a quote, when you realize this amazing young man was diagnosed with Ewing's Sarcoma (a rare,
            debilitating bone cancer) at the age of 7 and given only two weeks to live. Here he is, two years later,
            defying the odds and fighting on in a way too few of us could ever hope to emulate.</p>

        <img class="elijah img-responsive" alt="Elijah reading OSB" src="images/elijah.jpg"/>
        <p>32 cycles of chemotherapy. 15 surgical procedures. Over 70 tumors at initial diagnosis. In the two weeks
            from when they were all eliminated through aggressive chemotherapy, 9 of them stubbornly returned before
            he could undergo stem cell transplant therapy.</p>

        <p>Elijah Dimas has every reason to be down, depressed, and angry at the world. Instead, he insists on
            visiting hospitals &mdash; the very place he should reasonably hate! &mdash; during the holidays to cheer up
            other
            children! He is always smiling, always positive, and goes out of his way to make his own challenges
            easier on his family, friends, and supporters. He wants to live, and he wants to dedicate his life to
            helping others as a child life specialist.</p>

        <p>Elijah is a hero to everyone who knows him, and he's been fully adopted by the crew of HMS Implacable and
            the entire global community that is the Royal Manticoran Navy. His is the example we all strive to
            emulate, and now we want to step up and aid him and his family in every way we can.</p>

        <p>None are more dedicated to this than the grand author of the Honor Harrington series himself, David
            Weber. David has very kindly offered up a slot on his highly coveted First Readers List to the highest
            bidder of this special auction.</p>

        <p>This is an exclusive, closed list of individuals who receive advanced copies of David's manuscripts at
            the same time they are sent to the publisher, and long before anyone else ever gets to see the work.
            First readers see the work before any copy edit, giving them a chance to read it before anyone else and
            to see how the editing process can change between submission and final printing.</p>

        <p>The highest bidder for this charitable auction will be helping to defray the enormous expenses faced by
            Elijah's family as they continue to struggle day-to-day to make ends meet while taking care of their
            son. His treatments take him across the country, with frequent trips to Denver's Children's Hospital and
            as far as the Cleveland Clinic in Ohio. These trips and all the attendant costs are a severe hardship
            for these exceptional people; Elijah's mother, Patricia, quit her job to care for him full time, and his
            father, Anthony, works hard to support the whole family (often missing the trips in order to keep the
            core income flowing).</p>

        <p>This is your chance to join a highly exclusive club and be among the very privileged few who get to see
            the works of David Weber long before anyone else.</p>

        <p>It's also your opportunity to stand with a true hero, young of age and small of stature, but a giant of
            spirit and bravery who inspires us all.</p>

        <p>If you would like to help with Elijah's medical bills, his family has setup a <a
                    href="https://www.gofundme.com/mfvjfppg">GoFundMe</a> page where you can donate.</p>

        <p>Thank you.</p>
    </div>
    @if(Auth::check())

        <div class="panel panel-primary" id="bid-form">
            <div class="panel-heading">
                <h3 class="panel-title">
                    @if(time() > strtotime(config('bids.close')))
                        Bidding has closed
                    @else
                        How to Bid</h3>
                @endif
            </div>
            <div class="panel-body bids">
                @if(time() > strtotime(config('bids.close')))
                    <p>We're sorry, but bidding has closed. If you would still like to help, please visit Elijah's <a
                                href="https://www.gofundme.com/mfvjfppg">GoFundMe</a> page where you can make a donation
                        to help Elijah and his family</p>
                @else
                    @if(time() < strtotime(config('bids.open')))
                        <p>Bidding will open in <span id="countdown"></span>
                            on {{ date('F jS, Y', strtotime(config('bids.open'))) }} and close on
                            {{ date('F jS, Y', strtotime(config('bids.close'))) }}.</p>
                    @endif

                    <p>Only whole dollar bids will be accepted. @if(Auth::user()->confirmed === false)You must confirm
                        your email address to bid.
                        @endif
                        Once bidding has been closed, the winner will be notified by email. The winning bidder, once
                        notified, will have one week to donate to Elijah's GoFundMe campaign in an amount equal to or
                        greater than their bid amount. Once your donation has been confirmed, David Weber will be given
                        your name and email address to be added the the First Reader's list.</p>

                    {{--Only show bid form if it's past the opening date or skip_date_check is true AND the user has confirmed their email address--}}
                    @if((time() >= strtotime(config('bids.open')) || config('bids.skip_date_check') === true) && Auth::user()->confirmed === true)
                        <p>The current high bid is ${{ number_format($high_bid) }}. You must bid at least
                            ${{ number_format($high_bid + config('bids.increment')) }}</p>

                        <div class="well well-sm">
                            {{ Form::open(['route' => 'bid', 'class' => 'form-horizontal']) }}
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="bid">Enter a bid of at least
                                    ${{ number_format($high_bid + config('bids.increment')) }}</label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        {{ Form::text('bid', $high_bid + config('bids.increment'), ['type' => 'number', 'id' => 'bid', 'class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                {{ Form::submit('Place Bid', ['class' => 'btn btn-success']) }}
                            </div>

                            {{ Form::close() }}
                        </div>
                    @endif
                @endif
            </div>

        </div>
    @else
        <div class="panel panel-primary">
            <div class="panel-body bids">
                <p>You must register for an account or log in to be able to place a bid or check the status of your bid.</p>
            </div>
        </div>
    @endif

    <script>
        CountDownTimer('{{ config('bids.open') }}', 'countdown');

        function CountDownTimer(dt, id) {
            var end = new Date(dt);

            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var timer;

            function showRemaining() {
                var now = new Date();
                var distance = end - now;
                if (distance < 0) {

                    clearInterval(timer);
                    document.getElementById(id).innerHTML = '';

                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor((distance % _day) / _hour);
                var minutes = Math.floor((distance % _hour) / _minute);
                var seconds = Math.floor((distance % _minute) / _second);

                document.getElementById(id).innerHTML = days + ' days ';
                document.getElementById(id).innerHTML += hours + ' hrs ';
                document.getElementById(id).innerHTML += minutes + ' mins ';
                document.getElementById(id).innerHTML += seconds + ' secs';
            }

            timer = setInterval(showRemaining, 1000);
        }

    </script>
@endsection

