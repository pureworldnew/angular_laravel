<div class="row">
    <div class="col-sm-2 contentBoxHolder">
        <div class="contentBox bookingSection">
            {{ trans('booking/index.productHeading') }}
        </div>
    </div>
    <div class="col-sm-10 contentBoxHolder">
        <div class="row">
            <div class="col-sm-12 contentBoxHolder">
                <div class="contentBox">
                    <table class="table table-striped">
                        <tr>
                            <td>Kanadensare, Linder modell 1, kostnad 200 kr per dag<br>Bild!<br>Beskrivning!<br>3 st tillgängliga<br></td>
                            <td>{!! Form::open(array('url' => '/booking')) !!}
                                {!! Form::text('quantity', null, array('class' => 'form-control', 'placeholder' => 'antal objekt')) !!}
                                {{ Form::select('available_pricetypes', array('1' => 'Dagar', '2' => 'Förmiddag (8-12)', '3' => 'Eftermiddag (13-17)'), null, array('class' => 'form-control input-lg')) }}<br>
                                {!! Form::text('hours_or_days', null, array('class' => 'form-control', 'placeholder' => 'Dagar')) !!}
                                {!! Form::submit('Boka', array('class' => 'btn btn-warning')) !!}
                                {!! Form::close() !!}</td>
                        </tr>
                        <tr>
                            <td>Kanadensare, Linder modell 2, kostnad 250 kr per dag<br>Bild!<br>Beskrivning!<br>1 st tillgängliga<br></td>
                            <td>{!! Form::open(array('url' => '/booking')) !!}
                                {!! Form::text('quantity', null, array('class' => 'form-control', 'placeholder' => 'antal objekt')) !!}
                                {{ Form::select('available_pricetypes', array('1' => 'Dagar', '3' => 'Eftermiddag (13-17)', '4' => 'Per timme', ), null, array('class' => 'form-control input-lg')) }}<br>
                                {!! Form::text('hours_or_days', null, array('class' => 'form-control', 'placeholder' => 'Timmar')) !!}
                                {!! Form::submit('Boka', array('class' => 'btn btn-warning')) !!}
                                {!! Form::close() !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


