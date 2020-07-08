<div class="s-example-basic-single form-group cart-element mt-4 mb-4">
    {!! Form::select($name, $data, [], [
        'placeholder' => $placeholder,
        'id' => $id,
        'class' => (isset($class) ? $class : 'js-example-basic-single').' form-control form-control-user cart-select',
    ]); !!}
</div>



