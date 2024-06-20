@props([
    'type' => '' , 'name' , 'value' => '' , 'label' , 'col' => '' , 'span'=> ''
])


<div class="col-md-{{ $col ? $col : '6' }}">
<label for="{{ $name }}">{{ $label }}</label>
@if ($span)
<div class="input-group has-validation mb-3">
    <span class="input-group-text"></span>
    <input
        type="{{ $type ? $type : 'text' }}"
        name="{{ $name }}"
        value="{{ old($name , $value) }}"
        id="{{ $name }}"
        {{ $attributes->class([
        'form-control' ,
        ]) }}
    >
</div>
@else

<input
type="{{ $type ? $type : 'text' }}"
name="{{ $name }}"
value="{{ old($name , $value) }}"
id="{{ $name }}"
{{ $attributes->class([
'form-control' ,
]) }}
>
@endif



@error($name)
    <span class="text-danger">
        <small class="errorTxt">{{ $message }}</small>
    </span>
@enderror

</div>
