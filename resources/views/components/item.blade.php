@props([
  'active' => '' , 'label' , 'id'
])







<li class="nav-item">
    <a class="nav-link {{ $active ? 'active' : '' }}" data-bs-toggle="tab" href="#{{ $id }}" role="tab">
        {{ $label }}
    </a>
</li>
