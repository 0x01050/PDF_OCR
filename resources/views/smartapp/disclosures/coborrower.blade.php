@extends('smartapp.layout', [
    'back_button' => route('smartapp.disclosures.borrower', ['id' => $id]),
    'next_button' => route('smartapp.disclosures.demographic', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="description">
            If you answer "Yes" to any questions "a" through "i", please use continuation sheet for explanation.
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            a. Are there any outstanding judgments against you?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="outstanding_judgement" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_outstanding_judgement) && $disclosures_coborrower_outstanding_judgement == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="outstanding_judgement" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_outstanding_judgement) && $disclosures_coborrower_outstanding_judgement == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            b. Have you been declared bankrupt within the past 7 years?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="bankrupt_last_seven_years" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_bankrupt_last_seven_years) && $disclosures_coborrower_bankrupt_last_seven_years == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="bankrupt_last_seven_years" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_bankrupt_last_seven_years) && $disclosures_coborrower_bankrupt_last_seven_years == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            c. Have you had property foreclosed upon or given title or deed in lieu thereof in the last 7 years?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="property_foreclosure_last_seven_years" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_property_foreclosure_last_seven_years) && $disclosures_coborrower_property_foreclosure_last_seven_years == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="property_foreclosure_last_seven_years" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_property_foreclosure_last_seven_years) && $disclosures_coborrower_property_foreclosure_last_seven_years == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            d. Are you a party to a lawsuit?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="party_to_a_lawsuit" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_party_to_a_lawsuit) && $disclosures_coborrower_party_to_a_lawsuit == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="party_to_a_lawsuit" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_party_to_a_lawsuit) && $disclosures_coborrower_party_to_a_lawsuit == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            e. Have you directly or indirectly been obligated on any loan which resulted in foreclosure, transfer of title in lieu of foreclosure, or judgment? (This would include such loans as home mortgage loans, SBA loans, home improvement loans, educational loans, manufactured (mobile) home loans, any mortgage, financial obligation, bond, or loan guarantee. If "Yes," provide details, including date, name, and address of Lender, FHA or VA case number, if any, and reasons for the action.)
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="obligated_on_loan" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_obligated_on_loan) && $disclosures_coborrower_obligated_on_loan == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="obligated_on_loan" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_obligated_on_loan) && $disclosures_coborrower_obligated_on_loan == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            f. Are you presently delinquent or in default on any Federal debt or any other loan, mortgage, financial obligation, bond, or loan guarantee?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="delinquent_default_loan" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_delinquent_default_loan) && $disclosures_coborrower_delinquent_default_loan == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="delinquent_default_loan" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_delinquent_default_loan) && $disclosures_coborrower_delinquent_default_loan == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            g. Are you obligated to pay alimony, child support, or separate maintenance?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="alimony_child_support_separate_maintenance" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_alimony_child_support_separate_maintenance) && $disclosures_coborrower_alimony_child_support_separate_maintenance == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="alimony_child_support_separate_maintenance" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_alimony_child_support_separate_maintenance) && $disclosures_coborrower_alimony_child_support_separate_maintenance == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            h. Is any part of the down payment borrowed?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="down_payment_borrowed" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_down_payment_borrowed) && $disclosures_coborrower_down_payment_borrowed == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="down_payment_borrowed" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_down_payment_borrowed) && $disclosures_coborrower_down_payment_borrowed == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            i. Are you a co-maker or endorser on a note?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="co_maker_endorser_on_a_note" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_co_maker_endorser_on_a_note) && $disclosures_coborrower_co_maker_endorser_on_a_note == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="co_maker_endorser_on_a_note" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_co_maker_endorser_on_a_note) && $disclosures_coborrower_co_maker_endorser_on_a_note == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            j. Are you a U.S. citizen?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="us_citizen" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_us_citizen) && $disclosures_coborrower_us_citizen == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="us_citizen" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_us_citizen) && $disclosures_coborrower_us_citizen == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            k. Are you a permanent resident alien?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="permanent_resident_alien" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_permanent_resident_alien) && $disclosures_coborrower_permanent_resident_alien == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="permanent_resident_alien" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_permanent_resident_alien) && $disclosures_coborrower_permanent_resident_alien == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            l. Do you intend to occupy the property as your primary residence?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="primary_residence" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_primary_residence) && $disclosures_coborrower_primary_residence == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="primary_residence" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_primary_residence) && $disclosures_coborrower_primary_residence == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            m. Have you had an ownership interest in a property in the last three years?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="ownership_interest" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_ownership_interest) && $disclosures_coborrower_ownership_interest == "yes" ? "checked" : "") }} data-on="yes" data-target="#hold_title_field">
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="ownership_interest" data-type="disclosures" data-model="coborrower" {{ (isset($disclosures_coborrower_ownership_interest) && $disclosures_coborrower_ownership_interest == "no" ? "checked" : "") }} data-on="yes" data-target="#hold_title_field">
                No
            </div>
        </div>
    </div>

    <div class="item-field" id="hold_title_field"
        style="display: {{ (isset($disclosures_coborrower_ownership_interest) && $disclosures_coborrower_ownership_interest == 'yes') ? 'initial' : 'none' }};">
        <div class="question">
            How did you hold title
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="hold_title" data-type="disclosures" data-model="coborrower" style="width: calc(50% - 50px)">
                    @if(!isset($disclosures_coborrower_hold_title))
                        <option selected disabled value="">Select</option>
                    @endif
                    <option {{ (isset($disclosures_coborrower_hold_title) && $disclosures_coborrower_hold_title == "sole" ? "selected" : "") }} value="sole">Sole (individual)</option>
                    <option {{ (isset($disclosures_coborrower_hold_title) && $disclosures_coborrower_hold_title == "joint" ? "selected" : "") }} value="joint">Joint With Spouse</option>
                    <option {{ (isset($disclosures_coborrower_hold_title) && $disclosures_coborrower_hold_title == "joint_with_other_than_spouse" ? "selected" : "") }} value="joint_with_other_than_spouse">Joint With Other Than Spouse</option>
                </select>
            </div>
        </div>
    </div>
@endsection
