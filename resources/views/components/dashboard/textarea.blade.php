@props([
    'name' => null,
    'value' => null,
    'placeholder' => null,
    'label' => null
])

@if($label)
    <x-dashboard.label :id="$name">
        {{ $label }}
    </x-dashboard.label>
@endif

    <textarea {{ $attributes }} class="form-control" name="{{ $name }}" placeholder="{{ $placeholder }}" >{{old($name, $value)}}</textarea>
@error($name)
<p class="text-danger">{{ $message }}</p>
@enderror
