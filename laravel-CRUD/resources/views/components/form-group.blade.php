@props(['type', 'id', 'name', 'value'=> '', 'placeholder', 'label'])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input class="form-control" type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
        placeholder="{{ $placeholder }}" value="{{ old($name,$value) }}">

    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
