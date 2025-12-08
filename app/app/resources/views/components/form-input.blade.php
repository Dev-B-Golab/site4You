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

<div {{ $attributes->except(['class'])->merge() }}>
    @if($label)
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required) *@endif
    </label>
    @endif
    
    @if($type === 'textarea')
    <textarea 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-control form-control-custom @error($name) is-invalid @enderror" 
        rows="{{ $rows }}" 
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}>{{ old($name, $value) }}</textarea>
    @else
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-control form-control-custom @error($name) is-invalid @enderror" 
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}>
    @endif
    
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
