@extends('smartapp.layout', [
    'back_button' => route('smartapp.property.purpose', ['id' => $id]),
    'next_button' => route('smartapp.financial.combined', ['id' => $id])
])

@section('smartapp-content')
    @if (isset($financial_liquid))
        <div class="list_items">
            @foreach ($financial_liquid as $liq_id => $liq_var)
                <a class="list_item" href="{{ route('smartapp.financial.liquid.edit', ['id' => $id, 'liq_id' => $liq_id]) }}">
                    {{ $liq_var['name'] }}
                </a>
            @endforeach
        </div>
    @else
	    <div class="alert">
	        You don't have any accounts listed yet, please list all your checking and saving accounts.
	    </div>
    @endif
    <div class="list_buttons">
        <a href="{{ route('smartapp.financial.liquid.edit', ['id' => $id, 'liq_id' => $new_liq]) }}" class="list_button">
            Add accout
        </a>
    </div>
@endsection
