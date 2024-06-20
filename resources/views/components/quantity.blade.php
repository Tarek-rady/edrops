@props([
   'col' => '' , 'label' , 'name' , 'min' => '' , 'max' => '' , 'value' => '' , 'light' => ''
])




<div class="col-sm-{{ $col ? $col : '6' }}">
    <div>
        <h5 class="fs-13 fw-medium text-muted">{{ $label }}</h5>
        <div class="input-step full-width {{ $light ? 'light' : '' }}">
            <button type="button" class="minus shadow">–</button>
            <input
              type="number"
              name="{{ $name }}"
              id="{{ $name }}"
              class="product-quantity"
              value="{{ old($name , $value) }}"
              min="{{ $min ? $min : '0' }}"
              max="{{ $min ? $min : '100' }}" readonly>
            <button type="button" class="plus shadow">+</button>
        </div>
    </div>
</div>



