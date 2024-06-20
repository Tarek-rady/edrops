@props([
   'i' , 'color' , 'type' => '' , 'name' , 'value' => ''
])





<div class="mb-3 d-flex">
    <div class="avatar-xs d-block flex-shrink-0 me-3">
        <span class="avatar-title rounded-circle fs-16 bg-{{ $color }} shadow">
            <i class="{{ $i }}"></i>
        </span>
    </div>
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

