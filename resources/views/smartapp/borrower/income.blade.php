@extends('smartapp.layout', [
    'back_button' => route('smartapp.borrower.employment', ['id' => $id]),
    'next_button' => (isset($start_has_co_borrower) && $start_has_co_borrower == 'yes') ? route('smartapp.coborrower.info', ['id' => $id]) : route('smartapp.property.loan', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="description">
            Please note regarding income information: Income from alimony, child support, public assistance, or separate maintenance need not be revealed if the Borrower or Co-Borrower does not choose to have it considered for repaying the loan.
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Monthly Base Employment Income
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_income_base_income) ? $borrower_income_base_income : "") }}" class="updatable" name="base_income" data-type="borrower" data-model="income" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Monthly Overtime
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_income_overtime) ? $borrower_income_overtime : "") }}" class="updatable" name="overtime" data-type="borrower" data-model="income" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Monthly Bonuses
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_income_bonuses) ? $borrower_income_bonuses : "") }}" class="updatable" name="bonuses" data-type="borrower" data-model="income" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Monthly Commissions
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_income_commissions) ? $borrower_income_commissions : "") }}" class="updatable" name="commissions" data-type="borrower" data-model="income" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Monthly Dividends / Interest
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_income_dividends_interest) ? $borrower_income_dividends_interest : "") }}" class="updatable" name="dividends_interest" data-type="borrower" data-model="income" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Net Rental Income
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_income_net_rental_income) ? $borrower_income_net_rental_income : "") }}" class="updatable" name="net_rental_income" data-type="borrower" data-model="income" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Other
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_income_other) ? $borrower_income_other : "") }}" class="updatable" name="other" data-type="borrower" data-model="income" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>
@endsection
