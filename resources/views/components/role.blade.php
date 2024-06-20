
@props(['name', 'label', 'value' , 'col' => '' , 'options' => []])

<div class="col-md-{{ $col ? $col : '6' }}">



    <label for="{{ $name }}" class="form-label text-muted">{{ $label }}</label>

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'form-control js-example-basic-multiple']) }}>
        <option value="" disabled>{{ $label }}</option>
            @if ($value)
                <option value="{{$key}}" {{ ($value->roles->contains('name',$optionLabel)) ? 'selected' : ''}}>{{ $optionLabel }}</option>
            @endif

            @foreach ($options as $key => $optionLabel)

                <option value="{{ $key }}" {{ old($name) == $key ? 'selected' : '' }}>{{ __($optionLabel) }}</option>
            @endforeach

    </select>

</div>

@error($name)
<span class="text-danger">
    <small class="errorTxt">{{ $message }}</small>
</span>
@enderror
