@extends('smartapp.layout', [
    'back_button' => route('smartapp.financial.other', ['id' => $id]),
    'next_button' => route('smartapp.financial.other', ['id' => $id]),
    'remove_button' => route('smartapp.financial.other.remove', ['id' => $id, 'oth_id' => $oth_id])
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
                <input type="radio" value="borrower" class="updatable" name="borrower_id" data-type="financial" data-model="other" data-sub="{{$oth_id}}" {{ (isset($financial_other[$oth_id]['borrower_id']) && $financial_other[$oth_id]['borrower_id'] == "borrower" ? "checked" : "") }}>
                Borrower
            </div>
            <div>
                <input type="radio" value="co-borrower" class="updatable" name="borrower_id" data-type="financial" data-model="other" data-sub="{{$oth_id}}" {{ (isset($financial_other[$oth_id]['borrower_id']) && $financial_other[$oth_id]['borrower_id'] == "co-borrower" ? "checked" : "") }}>
                Co-Borrower
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Name
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_other[$oth_id]['name']) ? $financial_other[$oth_id]['name'] : "") }}" class="updatable" name="name" data-type="financial" data-model="other" data-sub="{{$oth_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Value
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_other[$oth_id]['value']) ? $financial_other[$oth_id]['value'] : "") }}" class="updatable" name="value" data-type="financial" data-model="other" data-sub="{{$oth_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>
@endsection
