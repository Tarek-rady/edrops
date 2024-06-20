@props(['name', 'label' , 'value'=> '' , 'col' => '', 'options' => []])


<div class="col-md-{{ $col ? $col : '6' }}">
    <label for="{{ $name }}" class="form-label text-muted">{{ $label }}</label>

    <select name="{{ $name }}[]" id="{{ $name }}" {{ $attributes->merge(['class' => 'form-control js-example-basic-multiple']) }} multiple>

        @if ($value != null)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endif
        <option value="" disabled> {{ __('models.countries') }} </option>
        @foreach ($options as $key => $optionLabel)
            <option value="{{ $key }}" {{ old($name) == $key ? 'selected' : '' }}>{{ __($optionLabel) }}</option>
        @endforeach

    </select>

    @error($name)
    <span class="text-danger">
        <small class="errorTxt">{{ $message }}</small>
    </span>
    @enderror
</div>



