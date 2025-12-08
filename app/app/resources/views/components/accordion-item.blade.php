{{-- 
    KOMPONENT: Element FAQ (accordion)
    Użycie: <x-accordion-item id="faq1" question="Pytanie?" answer="Odpowiedź" :open="true" />
    
    Props:
    - id: unikalny identyfikator (wymagany)
    - question: pytanie/tytuł
    - answer: odpowiedź (może zawierać HTML)
    - open: czy rozwinięty domyślnie (domyślnie: false)
    - parent: id parent accordion (domyślnie: 'faqAccordion')
--}}

@props([
    'id',
    'question',
    'answer' => null,
    'open' => false,
    'parent' => 'faqAccordion',
])

<div class="accordion-item">
    <h2 class="accordion-header" id="heading{{ $id }}">
        <button class="accordion-button {{ $open ? '' : 'collapsed' }}" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#collapse{{ $id }}" 
                aria-expanded="{{ $open ? 'true' : 'false' }}" 
                aria-controls="collapse{{ $id }}">
            {{ $question }}
        </button>
    </h2>
    <div id="collapse{{ $id }}" 
         class="accordion-collapse collapse {{ $open ? 'show' : '' }}" 
         aria-labelledby="heading{{ $id }}" 
         data-bs-parent="#{{ $parent }}">
        <div class="accordion-body">
            @if($answer)
                {!! $answer !!}
            @else
                {{ $slot }}
            @endif
        </div>
    </div>
</div>
