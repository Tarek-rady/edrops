@props([
    'name' , 'value' => '' , 'label'
])
<label for="{{ $name }}">{{ $label }}</label>
<textarea
name="{{ $name }}"
id="{{ $name }}"
{{ $attributes->class([
    'form-control' ,
    'summernote'
  ]) }}
>
{{ old($name , $value) }}
</textarea>


@error($name)
    <span class="text-danger">
        <small class="errorTxt">{{ $message }}</small>
    </span>
@enderror
