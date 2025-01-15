@props([
    'name' => null,
    'options' => [],
    'value' => null,
    'label' => null
])

@if($label)
    <x-dashboard.label :id="$name">
        {{ $label }}
    </x-dashboard.label>
@endif

<select {{ $attributes }} class="form-control" name="{{ $name }}">
    @foreach($options as $optionValue => $optionLabel)
        <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>{{ $optionLabel }}</option>
    @endforeach
</select>
@error($name)
<p class="text-danger">{{ $message }}</p>
@enderror
