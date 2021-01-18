@push('css')
    <style>
        .top-menu-bar
        {
            width: 100%;
            padding-left: 30px;
            background-color: #e0e0e0;
            display: flex;
            flex-direction: row;
        }
        @media(max-width: 700px)
        {
            .top-menu-bar
            {
                flex-direction: column;
            }
        }
        .top-menu-item
        {
            padding: 10px 15px;
            cursor: pointer;
            user-select: none;
            white-space: nowrap;
        }
        .top-menu-item.active
        {
            background-color: #c0c0c0;
        }
    </style>
@endpush
<div class="top-menu-bar mt-8">
    <a class="top-menu-item {{ $top == 'start' ? 'active' : ''  }}" href="{{ $top == 'start' ? '#' : route('smartapp.start', ['id' => $id]) }}">
        Start
    </a>
    <a class="top-menu-item {{ $top == 'borrower' ? 'active' : ''  }}" href="{{ $top == 'borrower' ? '#' : route('smartapp.borrower.info', ['id' => $id]) }}">
        Borrower
    </a>
    <a class="top-menu-item {{ $top == 'co-borrower' ? 'active' : ''  }}" href="{{ $top == 'co-borrower' ? '#' : route('smartapp.coborrower.info', ['id' => $id]) }}"
        id='co-borrower-menu' style="display: {{ (isset($start_has_co_borrower) && $start_has_co_borrower == 'yes') ? 'initial' : 'none' }};">
        Co-Borrower
    </a>
    <a class="top-menu-item {{ $top == 'property' ? 'active' : ''  }}" href="{{ $top == 'property' ? '#' : route('smartapp.property.loan', ['id' => $id]) }}">
        Property
    </a>
    <a class="top-menu-item {{ $top == 'financial' ? 'active' : ''  }}" href="{{ $top == 'financial' ? '#' : route('smartapp.financial.liquid', ['id' => $id]) }}">
        Financial
    </a>
    <a class="top-menu-item {{ $top ==  'disclosures' ? 'active' : ''  }}" href="{{ $top == 'disclosures' ? '#' : route('smartapp.disclosures.borrower', ['id' => $id]) }}">
        Disclosures
    </a>
    <a class="top-menu-item {{ $top == 'finish' ? 'active' : ''  }}" href="{{ $top == 'finish' ? '#' : route('smartapp.finish', ['id' => $id]) }}">
        Finish
    </a>
</div>
