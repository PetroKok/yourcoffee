<div class="form-group cart-element mt-4 mb-4">
    {!! Form::select('cities', $cities->toArray(true), [], [
        'placeholder' => 'Виберіть місто',
        'id' => 'cities',
        'class' => 'form-control form-control-user cart-select',
    ]); !!}
</div>

