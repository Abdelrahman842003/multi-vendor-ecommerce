@props([
    'type' => null,
    'name' => null,
    'placeholder' => null,
    'value' => null,
    'label' => null,
])

@if($label)
    <x-dashboard.label :id="$name">
        {{ $label }}
    </x-dashboard.label>
@endif

    <input class="form-control" type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{old($name, $value)}}" {{ $attributes }} />
@error($name)
<p class="text-danger">{{ $message }}</p>
@enderror
