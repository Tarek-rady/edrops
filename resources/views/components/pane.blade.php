@props([
   'active' => '' , 'id' , 'num'
])


<div class="tab-pane {{ $active ? 'active' : '' }}" id="{{ $id }}" role="tabpane{{ $num }}">

  {{ $slot }}
</div>
