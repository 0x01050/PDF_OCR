@extends('smartapp.layout', [
    'back_button' => route('smartapp.borrower.income', ['id' => $id]),
    'back_button' => (isset($start_has_co_borrower) && $start_has_co_borrower == 'yes') ? route('smartapp.coborrower.income', ['id' => $id]) : route('smartapp.borrower.income', ['id' => $id]),
    'next_button' => route('smartapp.property.purpose', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="question">
            Mortgage Applied For
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="mortgage_applied_for" data-type="property" data-model="loan" style="width: calc(50% - 50px)">
                    <option {{ (!isset($property_loan_mortgage_applied_for) ? "selected" : "") }} disabled value="">Select</option>
                    <option {{ (isset($property_loan_mortgage_applied_for) && $property_loan_mortgage_applied_for == "va" ? "selected" : "") }} value="va">VA</option>
                    <option {{ (isset($property_loan_mortgage_applied_for) && $property_loan_mortgage_applied_for == "fha" ? "selected" : "") }} value="fha">FHA</option>
                    <option {{ (isset($property_loan_mortgage_applied_for) && $property_loan_mortgage_applied_for == "conventional" ? "selected" : "") }} value="conventional">Conventional</option>
                    <option {{ (isset($property_loan_mortgage_applied_for) && $property_loan_mortgage_applied_for == "usda-rural-housing-service" ? "selected" : "") }} value="usda-rural-housing-service">USDA / Rural Housing Service</option>
                    <option {{ (isset($property_loan_mortgage_applied_for) && $property_loan_mortgage_applied_for == "other" ? "selected" : "") }} value="other">Other</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Please Explain
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_loan_other_mortgage_applied_for_explanation) ? $property_loan_other_mortgage_applied_for_explanation : "") }}" class="updatable" name="other_mortgage_applied_for_explanation" data-type="property" data-model="loan" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Loan Amount
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_loan_loan_amount) ? $property_loan_loan_amount : "") }}" class="updatable" name="loan_amount" data-type="property" data-model="loan" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Loan Term
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="number_of_months" data-type="property" data-model="loan" style="width: calc(50% - 50px)">
                    <option {{ (!isset($property_loan_number_of_months) ? "selected" : "") }} disabled value="">Select</option>
                    <option {{ (isset($property_loan_number_of_months) && $property_loan_number_of_months == "360" ? "selected" : "") }} value="360">360 months (30 years)</option>
                    <option {{ (isset($property_loan_number_of_months) && $property_loan_number_of_months == "240" ? "selected" : "") }} value="240">240 months (20 years)</option>
                    <option {{ (isset($property_loan_number_of_months) && $property_loan_number_of_months == "180" ? "selected" : "") }} value="180">180 months (15 years)</option>
                    <option {{ (isset($property_loan_number_of_months) && $property_loan_number_of_months == "120" ? "selected" : "") }} value="120">120 months (10 years)</option>
                    <option {{ (isset($property_loan_number_of_months) && $property_loan_number_of_months == "96" ? "selected" : "") }} value="96">96 months (8 years)</option>
                    <option {{ (isset($property_loan_number_of_months) && $property_loan_number_of_months == "84" ? "selected" : "") }} value="84">84 months (7 years)</option>
                    <option {{ (isset($property_loan_number_of_months) && $property_loan_number_of_months == "60" ? "selected" : "") }} value="60">60 months (5 years)</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Amortization Type
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="amortization_type" data-type="property" data-model="loan" style="width: calc(50% - 50px)">
                    <option {{ (!isset($property_loan_amortization_type) ? "selected" : "") }} disabled value="">Select</option>
                    <option {{ (isset($property_loan_amortization_type) && $property_loan_amortization_type == "fixed-rate" ? "selected" : "") }} value="fixed-rate">Fixed Rate</option>
                    <option {{ (isset($property_loan_amortization_type) && $property_loan_amortization_type == "gpm" ? "selected" : "gpm") }} value="">GPM</option>
                    <option {{ (isset($property_loan_amortization_type) && $property_loan_amortization_type == "arm" ? "selected" : "") }} value="arm">ARM</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            ARM Type
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_loan_arm_type) ? $property_loan_arm_type : "") }}" class="updatable" name="arm_type" data-type="property" data-model="loan" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>
@endsection
