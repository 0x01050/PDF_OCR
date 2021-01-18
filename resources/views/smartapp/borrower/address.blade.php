@extends('smartapp.layout', [
    'back_button' => route('smartapp.borrower.info', ['id' => $id]),
    'next_button' => route('smartapp.borrower.employment', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="question">
            Address 1
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_address_present_address_1) ? $borrower_address_present_address_1 : "") }}" class="updatable" name="present_address_1" data-type="borrower" data-model="address" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Address 2
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_address_present_address_2) ? $borrower_address_present_address_2 : "") }}" class="updatable" name="present_address_2" data-type="borrower" data-model="address" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            City
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_address_present_address_city) ? $borrower_address_present_address_city : "") }}" class="updatable" name="present_address_city" data-type="borrower" data-model="address" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            State
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="present_address_state" data-type="borrower" data-model="address" style="width: calc(50% - 50px)">
                    <option {{ (!isset($borrower_address_present_address_state) ? "selected" : "") }} disabled value="">Select a State</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "AL" ? "selected" : "") }} value="AL">Alabama</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "AK" ? "selected" : "") }} value="AK">Alaska</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "AZ" ? "selected" : "") }} value="AZ">Arizona</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "AR" ? "selected" : "") }} value="AR">Arkansas</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "CA" ? "selected" : "") }} value="CA">California</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "CO" ? "selected" : "") }} value="CO">Colorado</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "CT" ? "selected" : "") }} value="CT">Connecticut</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "DE" ? "selected" : "") }} value="DE">Delaware</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "DC" ? "selected" : "") }} value="DC">District Of Columbia</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "FL" ? "selected" : "") }} value="FL">Florida</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "GA" ? "selected" : "") }} value="GA">Georgia</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "HI" ? "selected" : "") }} value="HI">Hawaii</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "ID" ? "selected" : "") }} value="ID">Idaho</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "IL" ? "selected" : "") }} value="IL">Illinois</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "IN" ? "selected" : "") }} value="IN">Indiana</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "IA" ? "selected" : "") }} value="IA">Iowa</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "KS" ? "selected" : "") }} value="KS">Kansas</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "KY" ? "selected" : "") }} value="KY">Kentucky</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "LA" ? "selected" : "") }} value="LA">Louisiana</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "ME" ? "selected" : "") }} value="ME">Maine</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "MD" ? "selected" : "") }} value="MD">Maryland</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "MA" ? "selected" : "") }} value="MA">Massachusetts</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "MI" ? "selected" : "") }} value="MI">Michigan</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "MN" ? "selected" : "") }} value="MN">Minnesota</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "MS" ? "selected" : "") }} value="MS">Mississippi</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "MO" ? "selected" : "") }} value="MO">Missouri</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "MT" ? "selected" : "") }} value="MT">Montana</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "NE" ? "selected" : "") }} value="NE">Nebraska</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "NV" ? "selected" : "") }} value="NV">Nevada</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "NH" ? "selected" : "") }} value="NH">New Hampshire</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "NJ" ? "selected" : "") }} value="NJ">New Jersey</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "NM" ? "selected" : "") }} value="NM">New Mexico</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "NY" ? "selected" : "") }} value="NY">New York</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "NC" ? "selected" : "") }} value="NC">North Carolina</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "ND" ? "selected" : "") }} value="ND">North Dakota</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "OH" ? "selected" : "") }} value="OH">Ohio</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "OK" ? "selected" : "") }} value="OK">Oklahoma</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "OR" ? "selected" : "") }} value="OR">Oregon</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "PA" ? "selected" : "") }} value="PA">Pennsylvania</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "RI" ? "selected" : "") }} value="RI">Rhode Island</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "SC" ? "selected" : "") }} value="SC">South Carolina</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "SD" ? "selected" : "") }} value="SD">South Dakota</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "TN" ? "selected" : "") }} value="TN">Tennessee</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "TX" ? "selected" : "") }} value="TX">Texas</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "UT" ? "selected" : "") }} value="UT">Utah</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "VT" ? "selected" : "") }} value="VT">Vermont</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "VA" ? "selected" : "") }} value="VA">Virginia</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "WA" ? "selected" : "") }} value="WA">Washington</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "WV" ? "selected" : "") }} value="WV">West Virginia</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "WI" ? "selected" : "") }} value="WI">Wisconsin</option>
                    <option {{ (isset($borrower_address_present_address_state) && $borrower_address_present_address_state == "WY" ? "selected" : "") }} value="WY">Wyoming</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Zip Code
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_address_present_address_zip_code) ? $borrower_address_present_address_zip_code : "") }}" class="updatable" name="present_address_zip_code" data-type="borrower" data-model="address" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Rent / Own
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="present_address_own_rent" data-type="borrower" data-model="address" style="width: calc(50% - 50px)">
                    <option {{ (!isset($borrower_address_present_address_own_rent) ? "selected" : "") }} disabled value="">Select</option>
                    <option {{ (isset($borrower_address_present_address_own_rent) && $borrower_address_present_address_own_rent == "rent" ? "selected" : "") }} value="rent">Rent</option>
                    <option {{ (isset($borrower_address_present_address_own_rent) && $borrower_address_present_address_own_rent == "own" ? "selected" : "") }} value="own">Own</option>
                    <option {{ (isset($borrower_address_present_address_own_rent) && $borrower_address_present_address_own_rent == "living_rent_free" ? "selected" : "") }} value="living_rent_free">Living rent free</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            For how many years?
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_address_present_address_own_rent_number_of_years) ? $borrower_address_present_address_own_rent_number_of_years : "") }}" class="updatable" name="present_address_own_rent_number_of_years" data-type="borrower" data-model="address" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="answer">
            <div>
                <input type='checkbox' {{ (isset($borrower_address_address_is_mailing_address) && $borrower_address_address_is_mailing_address == 'on' ? "checked" : "") }} class="updatable" name="address_is_mailing_address" data-type="borrower" data-model="address" >
                <label for="address_is_mailing_address1">Mailing address is the same</label>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="answer">
            <div>
                <input type='checkbox' {{ (isset($borrower_address_address_lived_less_than_2_years) && $borrower_address_address_lived_less_than_2_years == 'on' ? "checked" : "") }} class="updatable" name="address_lived_less_than_2_years" data-type="borrower" data-model="address" >
                <label for="address_is_mailing_address2">Has the applicant been here less than 2 years?</label>
            </div>
        </div>
    </div>
@endsection
