
@props([
      'name' , 'label' , 'value'
])



<div class="custom-control custom-control-primary" style="display: inline-flex;">
    <input type="radio" class="custom-control {{ $name }}" name="{{ $name }}" value="{{ $value }}" />
    <label class="" for="">{{ $label }}</label>

    @error($name)
    <span class="text-danger">
        <small class="errorTxt">{{ $message }}</small>
    </span>
    @enderror
</div>


