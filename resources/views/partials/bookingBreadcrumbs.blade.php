<?php $link = true; ?>
<style>
    .breadcrumb li.active {
        font-weight:bold;
        color: #000;
    }
    .bookLink .btn {
        background: #f5f5f5;
        border:0;

    }
    .bookLink {
        display:inline-block;
    }

</style>
<div id="bookingBreadcrumbs">
    <ol class="breadcrumb">
        <li class="{{ $bookingStep == "book" ? 'active' : ''  }}" >
          @if($bookingStep !== "book" AND $link)
            {!! Form::open(array('url' => '/booking', 'method' => 'get', 'class' => 'bookLink')) !!}
                {!! Form::hidden('bookingId', Session::get('bookingId')) !!}
                {!! Form::submit(trans('booking/index.book'), array('class' => 'btn btn-default')) !!}
            {!! Form::close() !!}
            {{--<a href="/booking">{{ trans('booking/index.book') }}</a>--}}
          @else
            {{ trans('booking/index.book') }}
            <?php $link = false; ?>
          @endif
        </li>

        <li class="{{ $bookingStep == "confirm" ? 'active' : ''  }}" >
          @if($bookingStep !== "confirm" AND $link)
            {!! Form::open(array('url' => '/booking/confirm', 'method' => 'get', 'class' => 'bookLink')) !!}
                {!! Form::hidden('bookingId', Session::get('bookingId')) !!}
                {!! Form::submit(trans('booking/index.confirm'), array('class' => 'btn btn-default')) !!}
            {!! Form::close() !!}
            {{--<a href="/booking/confirm">{{ trans('booking/index.confirm') }}</a>--}}
          @else
            {{ trans('booking/index.confirm') }}
            <?php $link = false; ?>
          @endif
        </li>

        <li class="{{ $bookingStep == "pay" ? 'active' : ''  }}" >
          @if($bookingStep !== "pay" AND $link)
            {!! Form::open(array('url' => '/booking/pay', 'method' => 'get', 'class' => 'bookLink')) !!}
                {!! Form::hidden('bookingId', Session::get('bookingId')) !!}
                {!! Form::submit(trans('booking/index.pay'), array('class' => 'btn btn-default')) !!}
            {!! Form::close() !!}
            {{--<a href="/booking/pay">{{ trans('booking/index.pay') }}</a>--}}
          @else
            {{ trans('booking/index.pay') }}
            <?php $link = false; ?>
          @endif
        </li>

        <li class="{{ $bookingStep == "confirmation" ? 'active' : ''  }}" >
          @if($bookingStep !== "confirmation" AND $link)
            <a href="/booking/confirmation">{{ trans('booking/index.cartEmpty') }}</a>
          @else
            {{ trans('booking/index.confirmation') }}
            <?php $link = false; ?>
          @endif
        </li>

    </ol>

</div>
