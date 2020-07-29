<div class="s-example-basic-single form-group cart-element mt-3 mb-3">
    @php
        $invalid_class = ''
    @endphp
    @error($name)
        @php
            $invalid_class = 'invalid-feedback'
        @endphp
    @enderror
    {!! Form::select($name, $data, [], [
        'placeholder' => $placeholder,
        'id' => $id,
        'class' => (isset($class) ? $class : 'js-example-basic-single')." form-control form-control-user cart-select invalid-feedback ". $invalid_class,
    ]); !!}
</div>
@error($name)
<span class="cart-element invalid-feedback" role="alert" style="display: block">
            <strong>{{ $message }}</strong>
        </span>
@enderror



