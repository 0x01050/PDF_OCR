@extends('smartapp.layout', [
    'back_button' => route('smartapp.property.loan', ['id' => $id]),
    'next_button' => route('smartapp.financial.liquid', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="question">
            Purpose of Loan
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="purpose_of_loan" data-type="property" data-model="purpose" style="width: calc(50% - 50px)" data-on="other" data-target="#other_explain">
                    @if(!isset($property_purpose_purpose_of_loan))
                        <option selected disabled value="">Select</option>
                    @endif
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "purchase" ? "selected" : "") }} value="purchase">Purchasing a home</option>
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "refinance" ? "selected" : "") }} value="refinance">Refinance my existing loan</option>
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "construction" ? "selected" : "") }} value="construction">Construction</option>
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "construction-permanent" ? "selected" : "") }} value="construction-permanent">Construction Permanent</option>
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "other" ? "selected" : "") }} value="other">Other</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field" id="other_explain"
        style="display: {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == 'other') ? 'initial' : 'none' }};">
        <div class="question">
            Please Explain
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_purpose_other_explanation) ? $property_purpose_other_explanation : "") }}" class="updatable" name="other_explanation" data-type="property" data-model="purpose" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Property will be
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="property_will_be" data-type="property" data-model="purpose" style="width: calc(50% - 50px)">
                    @if(!isset($property_purpose_property_will_be))
                        <option selected disabled value="">Select</option>
                    @endif
                    <option {{ (isset($property_purpose_property_will_be) && $property_purpose_property_will_be == "primary-residence" ? "selected" : "") }} value="primary-residence">Primary Residence</option>
                    <option {{ (isset($property_purpose_property_will_be) && $property_purpose_property_will_be == "secondary-residence" ? "selected" : "") }} value="secondary-residence">Secondary Residence</option>
                    <option {{ (isset($property_purpose_property_will_be) && $property_purpose_property_will_be == "investment" ? "selected" : "") }} value="investment">Investment</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Purchase Price
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_purpose_purchase_price) ? $property_purpose_purchase_price : "") }}" class="updatable" name="purchase_price" data-type="property" data-model="purpose" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field" id="amount_existing_liens_field"
        style="display: {{ (isset($property_purpose_purpose_of_loan) && ($property_purpose_purpose_of_loan == 'refinance' || $property_purpose_purpose_of_loan == 'construction' || $property_purpose_purpose_of_loan == 'construction-permanent')) ? 'initial' : 'none' }};">
        <div class="question">
            Amount Existing Liens
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_purpose_amount_existing_liens) ? $property_purpose_amount_existing_liens : "") }}" class="updatable" name="amount_existing_liens" data-type="property" data-model="purpose" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field" id="purpose_of_refinance_field"
        style="display: {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == 'refinance') ? 'initial' : 'none' }};">
        <div class="question">
            Purpose of refinance
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="purpose_of_refinance" data-type="property" data-model="purpose" style="width: calc(50% - 50px)">
                    @if(!isset($property_purpose_purpose_of_refinance))
                        <option selected disabled value="">Select</option>
                    @endif
                    <option {{ (isset($property_purpose_purpose_of_refinance) && $property_purpose_purpose_of_refinance == "no_cash_out" ? "selected" : "") }} value="no_cash_out">No cash out</option>
                    <option {{ (isset($property_purpose_purpose_of_refinance) && $property_purpose_purpose_of_refinance == "cash_out_other" ? "selected" : "") }} value="cash_out_other">Cash out (other)</option>
                    <option {{ (isset($property_purpose_purpose_of_refinance) && $property_purpose_purpose_of_refinance == "cash_out_home_improvement" ? "selected" : "") }} value="cash_out_home_improvement">Cash out for home improvement</option>
                    <option {{ (isset($property_purpose_purpose_of_refinance) && $property_purpose_purpose_of_refinance == "cash_out_debt_consolidation" ? "selected" : "") }} value="cash_out_debt_consolidation">Cash out for debt consolidation</option>
                    <option {{ (isset($property_purpose_purpose_of_refinance) && $property_purpose_purpose_of_refinance == "limited_cash_out" ? "selected" : "") }} value="limited_cash_out">Limited cash out</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Manner in which title will be held
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_purpose_manner_in_which_title_will_be_held) ? $property_purpose_manner_in_which_title_will_be_held : "") }}" class="updatable" name="manner_in_which_title_will_be_held" data-type="property" data-model="purpose" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field" id="down_payment_source_field"
        style="display: {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == 'purchase') ? 'initial' : 'none' }};">
        <div class="question">
            Down Payment source
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="financing_source" data-type="property" data-model="purpose" style="width: calc(50% - 50px)" data-on="gift_funds" data-target="#gift_amount_field">
                    @if(!isset($property_purpose_financing_source))
                        <option selected disabled value="">Select</option>
                    @endif
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "checking_saving" ? "selected" : "") }} value="checking_saving">Checking/Savings</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "deposit_on_sales_contract" ? "selected" : "") }} value="deposit_on_sales_contract">Deposit on Sales Contract</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "equity_on_sold_property" ? "selected" : "") }} value="equity_on_sold_property">Equity on Sold Property</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "equity_from_ending_sale" ? "selected" : "") }} value="equity_from_ending_sale">Equity from Pending Sale</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "equity_from_subject_property" ? "selected" : "") }} value="equity_from_subject_property">Equity from Subject Property</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "gift_funds" ? "selected" : "") }} value="gift_funds">Gift Funds</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "stocks_and_bonds" ? "selected" : "") }} value="stocks_and_bonds">Stocks & Bonds</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "lot_equity" ? "selected" : "") }} value="lot_equity">Lot Equity</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "bridge_loan" ? "selected" : "") }} value="bridge_loan">Bridge Loan</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "unsecured_borrowed_funds" ? "selected" : "") }} value="unsecured_borrowed_funds">Unsecured Borrowed Funds</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "trust_funds" ? "selected" : "") }} value="trust_funds">Trust Funds</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "retirement_funds" ? "selected" : "") }} value="retirement_funds">Retirement Funds</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "rent_with_option_to_purchase" ? "selected" : "") }} value="rent_with_option_to_purchase">Rent with Option to Purchase</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "life_insurance_cash_value" ? "selected" : "") }} value="life_insurance_cash_value">Life Insurance Cash Value</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "sale_of_chattel" ? "selected" : "") }} value="sale_of_chattel">Sale of Chattel</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "trade_equity" ? "selected" : "") }} value="trade_equity">Trade Equity</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "sweat_equity" ? "selected" : "") }} value="sweat_equity">Sweat Equity</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "cash_on_hand" ? "selected" : "") }} value="cash_on_hand">Cash on Hand</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "other_type_of_down_payment" ? "selected" : "") }} value="other_type_of_down_payment">Other Type of Down Payment</option>
                    <option {{ (isset($property_purpose_financing_source) && $property_purpose_financing_source == "secured_borrowed_funds" ? "selected" : "") }} value="secured_borrowed_funds">Secured Borrowed Funds</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field" id="gift_amount_field"
        style="display: {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == 'purchase' && isset($property_purpose_financing_source) && $property_purpose_financing_source == 'gift_funds') ? 'initial' : 'none' }};">
        <div class="question">
            Gift amount
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_purpose_financing_source_amount) ? $property_purpose_financing_source_amount : "") }}" class="updatable" name="financing_source_amount" data-type="property" data-model="purpose" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("select[name='purpose_of_loan']").change(function(event) {
                purpose = $(event.target).val();
                if(purpose == 'purchase') {
                    $("#amount_existing_liens_field").hide();
                    $("#purpose_of_refinance_field").hide();
                    $("#down_payment_source_field").show();
                    if($("select[name='financing_source']").val() == 'gift_funds')
                        $("#gift_amount_field").show();
                    else
                        $("#gift_amount_field").hide();
                }
                if(purpose == 'refinance') {
                    $("#amount_existing_liens_field").show();
                    $("#purpose_of_refinance_field").show();
                    $("#down_payment_source_field").hide();
                    $("#gift_amount_field").hide();
                }
                if(purpose == 'construction' || purpose == 'construction-permanent') {
                    $("#amount_existing_liens_field").show();
                    $("#purpose_of_refinance_field").hide();
                    $("#down_payment_source_field").hide();
                    $("#gift_amount_field").hide();
                }
                if(purpose == 'other') {
                    $("#amount_existing_liens_field").hide();
                    $("#purpose_of_refinance_field").hide();
                    $("#down_payment_source_field").hide();
                    $("#gift_amount_field").hide();
                }
            });
        });
    </script>
@endpush
