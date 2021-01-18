@extends('smartapp.layout', [
    'back_button' => route('smartapp.financial.autos', ['id' => $id]),
    'next_button' => route('smartapp.financial.other', ['id' => $id])
])

@section('smartapp-content')
    @if (isset($financial_estate))
        <div class="list_items">
            @foreach ($financial_estate as $est_id => $est_var)
                <a class="list_item" href="{{ route('smartapp.financial.estate.edit', ['id' => $id, 'est_id' => $est_id]) }}">
                    <?php
                        $name = '';
                        if(isset($est_var['address_1']))
                            $name .= $est_var['address_1'];
                        if(isset($est_var['address_2']))
                            $name .= ', ' . $est_var['address_2'];
                        if(isset($est_var['city']))
                            $name .= ', ' . $est_var['city'];
                        if(isset($est_var['state']))
                            $name .= ', ' . $est_var['state'];
                        if(isset($est_var['zip_code']))
                            $name .= ', ' . $est_var['zip_code'];
                        $name = trim($name, ', ');
                    ?>
                    {{ $name }}
                </a>
            @endforeach
        </div>
    @else
	    <div class="alert">
	        You don't have any real estate schedules listed yet, please list all your real estate schedules below.
	    </div>
    @endif
    <div class="list_buttons">
        <a href="{{ route('smartapp.financial.estate.edit', ['id' => $id, 'est_id' => $new_est]) }}" class="list_button">
            Add real estate schedule
        </a>
    </div>
@endsection
