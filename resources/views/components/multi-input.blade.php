@props([
  'col' , 'main' , 'name' , 'type' => '' , 'label' , 'value' => ''
])


<div class="col-md-{{ $col }} col-12 mb-3">

    <div class="sub-{{ $main }}">
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
        <input
        type="{{ $type ? $type : 'text' }}"
        {{ $attributes->class([
            'form-control' ,
        ]) }}
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"

        >

    </div>


</div>
