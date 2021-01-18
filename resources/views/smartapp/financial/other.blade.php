@extends('smartapp.layout', [
    'back_button' => route('smartapp.financial.estate', ['id' => $id]),
    'next_button' => route('smartapp.financial.combined', ['id' => $id])
])

@section('smartapp-content')
    @if (isset($financial_other))
        <div class="list_items">
            @foreach ($financial_other as $oth_id => $oth_var)
                <a class="list_item" href="{{ route('smartapp.financial.other.edit', ['id' => $id, 'oth_id' => $oth_id]) }}">
                    {{ $oth_var['name'] }}
                </a>
            @endforeach
        </div>
    @else
	    <div class="alert">
	        If you have any other assets, please list them here.
	    </div>
    @endif
    <div class="list_buttons">
        <a href="{{ route('smartapp.financial.other.edit', ['id' => $id, 'oth_id' => $new_oth]) }}" class="list_button">
            Add asset accout
        </a>
    </div>
@endsection
