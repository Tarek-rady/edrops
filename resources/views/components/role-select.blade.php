@props(['name', 'label', 'value', 'col' => '', 'options' => []])

<div class="col-md-{{ $col ? $col : '6' }}">
    <label for="{{ $name }}" class="form-label text-muted">{{ $label }}</label>


    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'form-control js-example-basic-multiple']) }}>
        <option value="" disabled>{{ $label }}</option>

        @foreach ($options as $key => $optionLabel)
            @if ($value && $value->roles->contains('name', $optionLabel))
                <option value="{{$key}}" selected>{{ $optionLabel }}</option>
            @else
                <option value="{{ $key }}" {{ old($name) == $key ? 'selected' : '' }}>{{ __($optionLabel) }}</option>
            @endif
        @endforeach

    </select>


    @error($name)
    <span class="text-danger">
        <small class="errorTxt">{{ $message }}</small>
    </span>
    @enderror
</div>
