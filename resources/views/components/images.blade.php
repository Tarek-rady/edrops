@props([

    'label' , 'name' , 'id'=> '' , 'value'
])






<div class="col-md-6 col-12 mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input class="form-control" type="file" id="{{ $name }}"
        name="{{ $name }}[]"  multiple>

    @error($name)
        <span class="text-danger">
            <small class="errorTxt">{{ $message }}</small>
        </span>
    @enderror
</div>

<div class="carousel-inner" style="display: flex;" ></div><br>


</div>
