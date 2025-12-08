{{-- 
    KOMPONENT: Pole formularza
    Użycie: <x-form-input name="email" label="Email" type="email" required />
    
    Props:
    - name: nazwa pola (wymagany)
    - label: etykieta (opcjonalny)
    - type: typ inputa (text, email, tel, textarea - domyślnie: text)
    - placeholder: placeholder
    - required: czy wymagane (domyślnie: false)
    - rows: liczba wierszy dla textarea (domyślnie: 5)
    - value: wartość domyślna
--}}

@props([
    'name',
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'rows' => 5,
    'value' => null,
])

<div class="mb-3">
    @if($label)
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required) <span class="text-danger">*</span> @endif
    </label>
    @endif
    
    @if($type === 'textarea')
    <textarea 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-control" 
        rows="{{ $rows }}" 
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}>{{ $value }}</textarea>
    @else
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-control" 
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}>
    @endif
</div>
