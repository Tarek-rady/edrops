@props([

       'color' , 'name' , 'label'
])





<div class="d-grid gap-2" >
    <a href="" class="btn btn-{{ $color }} waves-effect waves-light btn-block add-input-value-{{ $name }}">{{ $label }}</a><br>
</div>


<div class="row">


    <div class="col-lg-12 row main-value-{{ $name }}" style="padding: 0">
        {{ $slot }}
    </div>
</div>
