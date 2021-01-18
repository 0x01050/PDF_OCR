@extends('smartapp.layout', [
    'back_button' => route('smartapp.financial.combined', ['id' => $id]),
    'next_button' => route('smartapp.financial.estate', ['id' => $id])
])

@section('smartapp-content')
    @if (isset($financial_autos))
        <div class="list_items">
            @foreach ($financial_autos as $aut_id => $aut_var)
                <a class="list_item" href="{{ route('smartapp.financial.autos.edit', ['id' => $id, 'aut_id' => $aut_id]) }}">
                    <?php
                        $name = '';
                        if(isset($aut_var['make']))
                            $name .= $aut_var['make'];
                        if(isset($aut_var['model']))
                            $name .= ' ' . $aut_var['model'];
                        if(isset($aut_var['year']))
                            $name .= ' ' . $aut_var['year'];
                        $name = trim($name);
                    ?>
                    {{ $name }}
                </a>
            @endforeach
        </div>
    @else
	    <div class="alert">
	        You don't have any automobiles listed yet.
	    </div>
    @endif
    <div class="list_buttons">
        <a href="{{ route('smartapp.financial.autos.edit', ['id' => $id, 'aut_id' => $new_aut]) }}" class="list_button">
            Autos
        </a>
    </div>
@endsection
