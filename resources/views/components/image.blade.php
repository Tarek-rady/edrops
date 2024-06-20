@props([

    'label' , 'name' , 'id'=> '' , 'value'
])










<div class="col-md-6 col-12 mb-3">
    <label for="{{ $id ? $id : 'formFile' }}" class="form-label">{{ $label }}</label>
    <input class="form-control image" type="file" id="{{ $id }}"
        name="{{ $name }}" >

    @error($name)
        <span class="text-danger">
            <small class="errorTxt">{{ $message }}</small>
        </span>
    @enderror
</div>

<div class="form-group prev">
    <img src="{{ $value ? asset('storage/' . $value) : '' }}" style="width: 100px" class="img-thumbnail preview-{{ $id }}" alt="">
</div>
