@extends('smartapp.layout', [
    'back_button' => route('smartapp.borrower.address', ['id' => $id]),
    'next_button' => route('smartapp.borrower.income', ['id' => $id])
])

@section('smartapp-content')
    @if (isset($borrower_employment))
        <div class="list_items">
            @foreach ($borrower_employment as $emp_id => $emp_var)
                <a class="list_item" href="{{ route('smartapp.borrower.employment.edit', ['id' => $id, 'emp_id' => $emp_id]) }}">
                    {{ $emp_var['name'] }}
                </a>
            @endforeach
        </div>
    @else
	    <div class="alert">
	        You don't have any employment history listed yet, please list 2 years of past and present employment history.
	    </div>
    @endif
    <div class="list_buttons">
        <a href="{{ route('smartapp.borrower.employment.edit', ['id' => $id, 'emp_id' => $new_emp]) }}" class="list_button">
            Add employment history
        </a>
    </div>
@endsection
