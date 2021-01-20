@extends('smartapp.layout', [
    'back_button' => route('smartapp.financial.autos', ['id' => $id]),
    'next_button' => route('smartapp.financial.autos', ['id' => $id]),
    'remove_button' => route('smartapp.financial.autos.remove', ['id' => $id, 'aut_id' => $aut_id])
])

@section('smartapp-content')
    <div class="item-field" style="display: {{ (isset($start_has_co_borrower) && $start_has_co_borrower == 'yes') ? 'initial' : 'none' }};">
        <div class="question">
            This asset belongs to:
            <div>
                <small>(do not add assets more than once even if shared)</small>
            </div>
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="borrower" class="updatable" name="borrower_id" data-type="financial" data-model="autos" data-sub="{{$aut_id}}" {{ (isset($financial_autos[$aut_id]['borrower_id']) && $financial_autos[$aut_id]['borrower_id'] == "borrower" ? "checked" : "") }}>
                Borrower
            </div>
            <div>
                <input type="radio" value="co-borrower" class="updatable" name="borrower_id" data-type="financial" data-model="autos" data-sub="{{$aut_id}}" {{ (isset($financial_autos[$aut_id]['borrower_id']) && $financial_autos[$aut_id]['borrower_id'] == "co-borrower" ? "checked" : "") }}>
                Co-Borrower
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Year
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_autos[$aut_id]['year']) ? $financial_autos[$aut_id]['year'] : "") }}" class="updatable" name="year" data-type="financial" data-model="autos" data-sub="{{$aut_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Make
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_autos[$aut_id]['make']) ? $financial_autos[$aut_id]['make'] : "") }}" class="updatable" name="make" data-type="financial" data-model="autos" data-sub="{{$aut_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Model
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_autos[$aut_id]['model']) ? $financial_autos[$aut_id]['model'] : "") }}" class="updatable" name="model" data-type="financial" data-model="autos" data-sub="{{$aut_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Value
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_autos[$aut_id]['value']) ? $financial_autos[$aut_id]['value'] : "") }}" class="updatable" name="value" data-type="financial" data-model="autos" data-sub="{{$aut_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>
@endsection
