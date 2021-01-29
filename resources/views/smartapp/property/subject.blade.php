@extends('smartapp.layout', [
    'back_button' => route('smartapp.property.purpose', ['id' => $id]),
    'next_button' => route('smartapp.financial.liquid', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="question">
            Address 1
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_subject_address_1) ? $property_subject_address_1 : "") }}" class="updatable" name="address_1" data-type="property" data-model="subject" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Address 2
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_subject_address_2) ? $property_subject_address_2 : "") }}" class="updatable" name="address_2" data-type="property" data-model="subject" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            City
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_subject_city) ? $property_subject_city : "") }}" class="updatable" name="city" data-type="property" data-model="subject" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            State
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="state" data-type="property" data-model="subject" style="width: calc(50% - 50px)">
                    @if(!isset($property_subject_state))
                        <option selected disabled value="">Select a State</option>
                    @endif
                    <option {{ (isset($property_subject_state) && $property_subject_state == "AL" ? "selected" : "") }} value="AL">Alabama</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "AK" ? "selected" : "") }} value="AK">Alaska</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "AZ" ? "selected" : "") }} value="AZ">Arizona</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "AR" ? "selected" : "") }} value="AR">Arkansas</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "CA" ? "selected" : "") }} value="CA">California</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "CO" ? "selected" : "") }} value="CO">Colorado</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "CT" ? "selected" : "") }} value="CT">Connecticut</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "DE" ? "selected" : "") }} value="DE">Delaware</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "DC" ? "selected" : "") }} value="DC">District Of Columbia</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "FL" ? "selected" : "") }} value="FL">Florida</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "GA" ? "selected" : "") }} value="GA">Georgia</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "HI" ? "selected" : "") }} value="HI">Hawaii</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "ID" ? "selected" : "") }} value="ID">Idaho</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "IL" ? "selected" : "") }} value="IL">Illinois</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "IN" ? "selected" : "") }} value="IN">Indiana</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "IA" ? "selected" : "") }} value="IA">Iowa</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "KS" ? "selected" : "") }} value="KS">Kansas</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "KY" ? "selected" : "") }} value="KY">Kentucky</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "LA" ? "selected" : "") }} value="LA">Louisiana</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "ME" ? "selected" : "") }} value="ME">Maine</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "MD" ? "selected" : "") }} value="MD">Maryland</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "MA" ? "selected" : "") }} value="MA">Massachusetts</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "MI" ? "selected" : "") }} value="MI">Michigan</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "MN" ? "selected" : "") }} value="MN">Minnesota</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "MS" ? "selected" : "") }} value="MS">Mississippi</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "MO" ? "selected" : "") }} value="MO">Missouri</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "MT" ? "selected" : "") }} value="MT">Montana</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "NE" ? "selected" : "") }} value="NE">Nebraska</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "NV" ? "selected" : "") }} value="NV">Nevada</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "NH" ? "selected" : "") }} value="NH">New Hampshire</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "NJ" ? "selected" : "") }} value="NJ">New Jersey</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "NM" ? "selected" : "") }} value="NM">New Mexico</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "NY" ? "selected" : "") }} value="NY">New York</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "NC" ? "selected" : "") }} value="NC">North Carolina</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "ND" ? "selected" : "") }} value="ND">North Dakota</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "OH" ? "selected" : "") }} value="OH">Ohio</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "OK" ? "selected" : "") }} value="OK">Oklahoma</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "OR" ? "selected" : "") }} value="OR">Oregon</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "PA" ? "selected" : "") }} value="PA">Pennsylvania</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "RI" ? "selected" : "") }} value="RI">Rhode Island</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "SC" ? "selected" : "") }} value="SC">South Carolina</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "SD" ? "selected" : "") }} value="SD">South Dakota</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "TN" ? "selected" : "") }} value="TN">Tennessee</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "TX" ? "selected" : "") }} value="TX">Texas</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "UT" ? "selected" : "") }} value="UT">Utah</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "VT" ? "selected" : "") }} value="VT">Vermont</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "VA" ? "selected" : "") }} value="VA">Virginia</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "WA" ? "selected" : "") }} value="WA">Washington</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "WV" ? "selected" : "") }} value="WV">West Virginia</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "WI" ? "selected" : "") }} value="WI">Wisconsin</option>
                    <option {{ (isset($property_subject_state) && $property_subject_state == "WY" ? "selected" : "") }} value="WY">Wyoming</option>
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
                <input type='text' value="{{ (isset($property_subject_zip_code) ? $property_subject_zip_code : "") }}" class="updatable" name="zip_code" data-type="property" data-model="subject" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Zip Code - 4
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_subject_zip_code_4) ? $property_subject_zip_code_4 : "") }}" class="updatable" name="zip_code_4" data-type="property" data-model="subject" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Number of Units
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_subject_no_units) ? $property_subject_no_units : "") }}" class="updatable" name="no_units" data-type="property" data-model="subject" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Year Built
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_subject_year_built) ? $property_subject_year_built : "") }}" class="updatable" name="year_built" data-type="property" data-model="subject" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Type
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($property_subject_type) ? $property_subject_type : "") }}" class="updatable" name="type" data-type="property" data-model="subject" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>
@endsection
