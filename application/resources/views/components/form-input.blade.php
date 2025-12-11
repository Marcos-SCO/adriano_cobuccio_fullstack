@props([
    'label' => '',
    'name',
    'type' => 'text',
    'value' => null,
    'step' => null,
    'errorBag' => null,
    'required' => false,
])

@php
    $bag = $errorBag ? $errors->getBag($errorBag) : $errors;
    $hasError = $bag->has($name);
    $inputClasses = 'mt-1 w-full px-3 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-green-200';

    if ($hasError) {
        $inputClasses .= ' border-red-500';
    }
@endphp

<div>
    <label for="{{ $name }}" class="block text-gray-700">{{ $label }}</label>

    @if ($type == 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" @if ($required) required @endif
            {{ $attributes->merge(['class' => $inputClasses]) }}>{{ old($name, $value) }}
        </textarea>
    @endif

    @if ($type !== 'textarea')
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            @if ($type !== 'password') value="{{ old($name, $value) }}" @endif
            @if ($step) step="{{ $step }}" @endif
            @if ($required) required @endif {{ $attributes->merge(['class' => $inputClasses]) }}>
    @endif

    @if ($hasError)
        <p class="text-red-500 text-sm mt-1">{{ $bag->first($name) }}</p>
    @endif
</div>
