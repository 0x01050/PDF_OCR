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
                <select class="updatable" name="purpose_of_loan" data-type="property" data-model="purpose" style="width: calc(50% - 50px)">
                    <option {{ (!isset($property_purpose_purpose_of_loan) ? "selected" : "") }} disabled value="">Select</option>
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "purchase" ? "selected" : "") }} value="purchase">Purchasing a home</option>
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "refinance" ? "selected" : "") }} value="refinance">Refinance my existing loan</option>
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "construction" ? "selected" : "") }} value="construction">Construction</option>
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "construction-permanent" ? "selected" : "") }} value="construction-permanent">Construction Permanent</option>
                    <option {{ (isset($property_purpose_purpose_of_loan) && $property_purpose_purpose_of_loan == "other" ? "selected" : "") }} value="other">Other</option>
                </select>
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
                    <option {{ (!isset($property_purpose_property_will_be) ? "selected" : "") }} disabled value="">Select</option>
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

    <div class="item-field">
        <div class="question">
            Amount Existing Liens
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_purpose_amount_existing_liens) ? $property_purpose_amount_existing_liens : "") }}" class="updatable" name="amount_existing_liens" data-type="property" data-model="purpose" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Purpose of refinance
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="purpose_of_refinance" data-type="property" data-model="purpose" style="width: calc(50% - 50px)">
                    <option {{ (!isset($property_purpose_purpose_of_refinance) ? "selected" : "") }} disabled value="">Select</option>
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
@endsection
