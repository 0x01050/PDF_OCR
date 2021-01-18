@extends('smartapp.layout', [
    'back_button' => route('smartapp.borrower.employment', ['id' => $id]),
    'next_button' => route('smartapp.borrower.employment', ['id' => $id]),
    'remove_button' => route('smartapp.borrower.employment.remove', ['id' => $id, 'emp_id' => $emp_id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="question">
            Self Employed?
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="self_employed" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)">
                    <option {{ (!isset($borrower_employment[$emp_id]['self_employed']) ? "selected" : "") }} disabled value="">Select</option>
                    <option {{ (isset($borrower_employment[$emp_id]['self_employed']) && $borrower_employment[$emp_id]['self_employed'] == "yes" ? "selected" : "") }} value="yes">Yes</option>
                    <option {{ (isset($borrower_employment[$emp_id]['self_employed']) && $borrower_employment[$emp_id]['self_employed'] == "no" ? "selected" : "") }} value="no">No</option>
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
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['name']) ? $borrower_employment[$emp_id]['name'] : "") }}" class="updatable" name="name" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Address 1
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['address_1']) ? $borrower_employment[$emp_id]['address_1'] : "") }}" class="updatable" name="address_1" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Address 2
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['address_2']) ? $borrower_employment[$emp_id]['address_2'] : "") }}" class="updatable" name="address_2" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            City
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['city']) ? $borrower_employment[$emp_id]['city'] : "") }}" class="updatable" name="city" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            State
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="state" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)">
                    <option {{ (!isset($borrower_employment[$emp_id]['state']) ? "selected" : "") }} disabled value="">Select a State</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "AL" ? "selected" : "") }} value="AL">Alabama</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "AK" ? "selected" : "") }} value="AK">Alaska</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "AZ" ? "selected" : "") }} value="AZ">Arizona</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "AR" ? "selected" : "") }} value="AR">Arkansas</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "CA" ? "selected" : "") }} value="CA">California</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "CO" ? "selected" : "") }} value="CO">Colorado</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "CT" ? "selected" : "") }} value="CT">Connecticut</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "DE" ? "selected" : "") }} value="DE">Delaware</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "DC" ? "selected" : "") }} value="DC">District Of Columbia</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "FL" ? "selected" : "") }} value="FL">Florida</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "GA" ? "selected" : "") }} value="GA">Georgia</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "HI" ? "selected" : "") }} value="HI">Hawaii</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "ID" ? "selected" : "") }} value="ID">Idaho</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "IL" ? "selected" : "") }} value="IL">Illinois</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "IN" ? "selected" : "") }} value="IN">Indiana</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "IA" ? "selected" : "") }} value="IA">Iowa</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "KS" ? "selected" : "") }} value="KS">Kansas</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "KY" ? "selected" : "") }} value="KY">Kentucky</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "LA" ? "selected" : "") }} value="LA">Louisiana</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "ME" ? "selected" : "") }} value="ME">Maine</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "MD" ? "selected" : "") }} value="MD">Maryland</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "MA" ? "selected" : "") }} value="MA">Massachusetts</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "MI" ? "selected" : "") }} value="MI">Michigan</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "MN" ? "selected" : "") }} value="MN">Minnesota</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "MS" ? "selected" : "") }} value="MS">Mississippi</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "MO" ? "selected" : "") }} value="MO">Missouri</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "MT" ? "selected" : "") }} value="MT">Montana</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "NE" ? "selected" : "") }} value="NE">Nebraska</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "NV" ? "selected" : "") }} value="NV">Nevada</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "NH" ? "selected" : "") }} value="NH">New Hampshire</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "NJ" ? "selected" : "") }} value="NJ">New Jersey</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "NM" ? "selected" : "") }} value="NM">New Mexico</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "NY" ? "selected" : "") }} value="NY">New York</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "NC" ? "selected" : "") }} value="NC">North Carolina</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "ND" ? "selected" : "") }} value="ND">North Dakota</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "OH" ? "selected" : "") }} value="OH">Ohio</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "OK" ? "selected" : "") }} value="OK">Oklahoma</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "OR" ? "selected" : "") }} value="OR">Oregon</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "PA" ? "selected" : "") }} value="PA">Pennsylvania</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "RI" ? "selected" : "") }} value="RI">Rhode Island</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "SC" ? "selected" : "") }} value="SC">South Carolina</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "SD" ? "selected" : "") }} value="SD">South Dakota</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "TN" ? "selected" : "") }} value="TN">Tennessee</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "TX" ? "selected" : "") }} value="TX">Texas</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "UT" ? "selected" : "") }} value="UT">Utah</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "VT" ? "selected" : "") }} value="VT">Vermont</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "VA" ? "selected" : "") }} value="VA">Virginia</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "WA" ? "selected" : "") }} value="WA">Washington</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "WV" ? "selected" : "") }} value="WV">West Virginia</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "WI" ? "selected" : "") }} value="WI">Wisconsin</option>
                    <option {{ (isset($borrower_employment[$emp_id]['state']) && $borrower_employment[$emp_id]['state'] == "WY" ? "selected" : "") }} value="WY">Wyoming</option>
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
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['zip_code']) ? $borrower_employment[$emp_id]['zip_code'] : "") }}" class="updatable" name="zip_code" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Phone Number
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['phone_number']) ? $borrower_employment[$emp_id]['phone_number'] : "") }}" class="updatable" name="phone_number" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Start Date
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['start_date']) ? $borrower_employment[$emp_id]['start_date'] : "") }}" placeholder="mm/dd/yyyy" class="updatable" name="start_date" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            End Date
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['end_date']) ? $borrower_employment[$emp_id]['end_date'] : "") }}" placeholder="mm/dd/yyyy" class="updatable" name="end_date" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="answer">
            <div>
                <input type='checkbox' {{ (isset($borrower_employment[$emp_id]['currently_employed']) && $borrower_employment[$emp_id]['currently_employed'] == 'on' ? "checked" : "") }} class="updatable" name="currently_employed" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" >
                <label for="currently_employed">Currently Employed Here</label>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Position/Title/Type of Business
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['position_title_type_of_business']) ? $borrower_employment[$emp_id]['position_title_type_of_business'] : "") }}" class="updatable" name="position_title_type_of_business" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Years employed in this line of work/profession
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_employment[$emp_id]['years_in_profession']) ? $borrower_employment[$emp_id]['years_in_profession'] : "") }}" class="updatable" name="years_in_profession" data-type="borrower" data-model="employment" data-sub="{{$emp_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>
@endsection
