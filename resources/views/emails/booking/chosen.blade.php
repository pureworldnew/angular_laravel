<div class="row">
    <div class="col-sm-2 contentBoxHolder">
        <div class="contentBox bookingSection">
            {{ trans('booking/index.chosenHeading') }}
        </div>
    </div>
    <div class="col-sm-10 contentBoxHolder">
        <div class="row">
            <div class="col-sm-12 contentBoxHolder">
                <div class="contentBox">
                    @include('partials/selectedProducts')
                </div>
            </div>
        </div>
    </div>
</div>