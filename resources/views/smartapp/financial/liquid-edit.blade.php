@extends('smartapp.layout', [
    'back_button' => route('smartapp.financial.liquid', ['id' => $id]),
    'next_button' => route('smartapp.financial.liquid', ['id' => $id]),
    'remove_button' => route('smartapp.financial.liquid.remove', ['id' => $id, 'liq_id' => $liq_id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="question">
            This asset belongs to:
            <div>
                <small>(do not add assets more than once even if shared)</small>
            </div>
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="borrower" class="updatable" name="borrower_id" data-type="financial" data-model="liquid" data-sub="{{$liq_id}}" {{ (isset($financial_liquid[$liq_id]['borrower_id']) && $financial_liquid[$liq_id]['borrower_id'] == "borrower" ? "checked" : "") }}>
                Borrower
            </div>
            <div>
                <input type="radio" value="co-borrower" class="updatable" name="borrower_id" data-type="financial" data-model="liquid" data-sub="{{$liq_id}}" {{ (isset($financial_liquid[$liq_id]['borrower_id']) && $financial_liquid[$liq_id]['borrower_id'] == "co-borrower" ? "checked" : "") }}>
                Co-Borrower
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Account Type
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="type" data-type="financial" data-model="liquid" data-sub="{{$liq_id}}" style="width: calc(50% - 50px)">
                    @if(!isset($financial_liquid[$liq_id]['type']))
                        <option selected disabled value="">Select</option>
                    @endif
                    <option {{ (isset($financial_liquid[$liq_id]['type']) && $financial_liquid[$liq_id]['type'] == "savings-account" ? "selected" : "") }} value="savings-account">Savings Account</option>
                    <option {{ (isset($financial_liquid[$liq_id]['type']) && $financial_liquid[$liq_id]['type'] == "checking-account" ? "selected" : "") }} value="checking-account">Checking Account</option>
                    <option {{ (isset($financial_liquid[$liq_id]['type']) && $financial_liquid[$liq_id]['type'] == "stocks" ? "selected" : "") }} value="stocks">Stocks</option>
                    <option {{ (isset($financial_liquid[$liq_id]['type']) && $financial_liquid[$liq_id]['type'] == "bonds" ? "selected" : "") }} value="bonds">Bonds</option>
                    <option {{ (isset($financial_liquid[$liq_id]['type']) && $financial_liquid[$liq_id]['type'] == "certificate-deposit" ? "selected" : "") }} value="certificate-deposit">Certificate Deposit</option>
                    <option {{ (isset($financial_liquid[$liq_id]['type']) && $financial_liquid[$liq_id]['type'] == "money-market-fund" ? "selected" : "") }} value="money-market-fund">Money Market Fund</option>
                    <option {{ (isset($financial_liquid[$liq_id]['type']) && $financial_liquid[$liq_id]['type'] == "mutual-fund" ? "selected" : "") }} value="mutual-fund">Mutual Fund</option>
                    <option {{ (isset($financial_liquid[$liq_id]['type']) && $financial_liquid[$liq_id]['type'] == "trust-fund" ? "selected" : "") }} value="trust-fund">Trust Fund</option>
                    <option {{ (isset($financial_liquid[$liq_id]['type']) && $financial_liquid[$liq_id]['type'] == "other" ? "selected" : "") }} value="other">Other</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Name
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_liquid[$liq_id]['name']) ? $financial_liquid[$liq_id]['name'] : "") }}" class="updatable" name="name" data-type="financial" data-model="liquid" data-sub="{{$liq_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Account Number
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_liquid[$liq_id]['account_number']) ? $financial_liquid[$liq_id]['account_number'] : "") }}" class="updatable" name="account_number" data-type="financial" data-model="liquid" data-sub="{{$liq_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Account Balance
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_liquid[$liq_id]['account_balance']) ? $financial_liquid[$liq_id]['account_balance'] : "") }}" class="updatable" name="account_balance" data-type="financial" data-model="liquid" data-sub="{{$liq_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>
@endsection
