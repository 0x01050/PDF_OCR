@extends('smartapp.layout', [
    'back_button' => route('smartapp.financial.estate', ['id' => $id]),
    'next_button' => route('smartapp.financial.estate', ['id' => $id]),
    'remove_button' => route('smartapp.financial.estate.remove', ['id' => $id, 'est_id' => $est_id])
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
                <input type="radio" value="borrower" class="updatable" name="borrower_id" data-type="financial" data-model="estate" data-sub="{{$est_id}}" {{ (isset($financial_estate[$est_id]['borrower_id']) && $financial_estate[$est_id]['borrower_id'] == "borrower" ? "checked" : "") }}>
                Borrower
            </div>
            <div>
                <input type="radio" value="co-borrower" class="updatable" name="borrower_id" data-type="financial" data-model="estate" data-sub="{{$est_id}}" {{ (isset($financial_estate[$est_id]['borrower_id']) && $financial_estate[$est_id]['borrower_id'] == "co-borrower" ? "checked" : "") }}>
                Co-Borrower
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Status
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="status" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)">
                    <option {{ (!isset($financial_estate[$est_id]['status']) ? "selected" : "") }} disabled value="">Select</option>
                    <option {{ (isset($financial_estate[$est_id]['status']) && $financial_estate[$est_id]['status'] == "sold" ? "selected" : "") }} value="sold">Sold</option>
                    <option {{ (isset($financial_estate[$est_id]['status']) && $financial_estate[$est_id]['status'] == "pending-sale" ? "selected" : "") }} value="pending-sale">Pending Sale</option>
                    <option {{ (isset($financial_estate[$est_id]['status']) && $financial_estate[$est_id]['status'] == "rental" ? "selected" : "") }} value="rental">Rental</option>
                    <option {{ (isset($financial_estate[$est_id]['status']) && $financial_estate[$est_id]['status'] == "retained" ? "selected" : "") }} value="retained">Retained</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Type of Property
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="type_of_property" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)">
                    <option {{ (!isset($financial_estate[$est_id]['type_of_property']) ? "selected" : "") }} disabled value="">Select</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "single-family-residence" ? "selected" : "") }} value="single-family-residence">Single Family Residence</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "two-to-fourplex" ? "selected" : "") }} value="two-to-fourplex">Two to Fourplex</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "commercial-non-residential" ? "selected" : "") }} value="commercial-non-residential">Commercial Non-residential</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "commercial-residential" ? "selected" : "") }} value="commercial-residential">Commercial Residential</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "condominium" ? "selected" : "") }} value="condominium">Condominium</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "co-op" ? "selected" : "") }} value="co-op">Co-Op</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "farm" ? "selected" : "") }} value="farm">Farm</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "land" ? "selected" : "") }} value="land">Land</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "mixed-use-property" ? "selected" : "") }} value="mixed-use-property">Mixed Use Property</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "mobile-home" ? "selected" : "") }} value="mobile-home">Mobile Home</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "multi-family-property" ? "selected" : "") }} value="multi-family-property">Multi-Family Property</option>
                    <option {{ (isset($financial_estate[$est_id]['type_of_property']) && $financial_estate[$est_id]['type_of_property'] == "townhouse" ? "selected" : "") }} value="townhouse">Townhouse</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Address 1
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_estate[$est_id]['address_1']) ? $financial_estate[$est_id]['address_1'] : "") }}" class="updatable" name="address_1" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Address 2
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_estate[$est_id]['address_2']) ? $financial_estate[$est_id]['address_2'] : "") }}" class="updatable" name="address_2" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            City
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_estate[$est_id]['city']) ? $financial_estate[$est_id]['city'] : "") }}" class="updatable" name="city" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            State
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="state" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)">
                    <option {{ (!isset($financial_estate[$est_id]['state']) ? "selected" : "") }} disabled value="">Select a State</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "AL" ? "selected" : "") }} value="AL">Alabama</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "AK" ? "selected" : "") }} value="AK">Alaska</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "AZ" ? "selected" : "") }} value="AZ">Arizona</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "AR" ? "selected" : "") }} value="AR">Arkansas</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "CA" ? "selected" : "") }} value="CA">California</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "CO" ? "selected" : "") }} value="CO">Colorado</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "CT" ? "selected" : "") }} value="CT">Connecticut</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "DE" ? "selected" : "") }} value="DE">Delaware</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "DC" ? "selected" : "") }} value="DC">District Of Columbia</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "FL" ? "selected" : "") }} value="FL">Florida</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "GA" ? "selected" : "") }} value="GA">Georgia</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "HI" ? "selected" : "") }} value="HI">Hawaii</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "ID" ? "selected" : "") }} value="ID">Idaho</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "IL" ? "selected" : "") }} value="IL">Illinois</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "IN" ? "selected" : "") }} value="IN">Indiana</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "IA" ? "selected" : "") }} value="IA">Iowa</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "KS" ? "selected" : "") }} value="KS">Kansas</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "KY" ? "selected" : "") }} value="KY">Kentucky</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "LA" ? "selected" : "") }} value="LA">Louisiana</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "ME" ? "selected" : "") }} value="ME">Maine</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "MD" ? "selected" : "") }} value="MD">Maryland</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "MA" ? "selected" : "") }} value="MA">Massachusetts</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "MI" ? "selected" : "") }} value="MI">Michigan</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "MN" ? "selected" : "") }} value="MN">Minnesota</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "MS" ? "selected" : "") }} value="MS">Mississippi</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "MO" ? "selected" : "") }} value="MO">Missouri</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "MT" ? "selected" : "") }} value="MT">Montana</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "NE" ? "selected" : "") }} value="NE">Nebraska</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "NV" ? "selected" : "") }} value="NV">Nevada</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "NH" ? "selected" : "") }} value="NH">New Hampshire</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "NJ" ? "selected" : "") }} value="NJ">New Jersey</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "NM" ? "selected" : "") }} value="NM">New Mexico</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "NY" ? "selected" : "") }} value="NY">New York</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "NC" ? "selected" : "") }} value="NC">North Carolina</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "ND" ? "selected" : "") }} value="ND">North Dakota</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "OH" ? "selected" : "") }} value="OH">Ohio</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "OK" ? "selected" : "") }} value="OK">Oklahoma</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "OR" ? "selected" : "") }} value="OR">Oregon</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "PA" ? "selected" : "") }} value="PA">Pennsylvania</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "RI" ? "selected" : "") }} value="RI">Rhode Island</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "SC" ? "selected" : "") }} value="SC">South Carolina</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "SD" ? "selected" : "") }} value="SD">South Dakota</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "TN" ? "selected" : "") }} value="TN">Tennessee</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "TX" ? "selected" : "") }} value="TX">Texas</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "UT" ? "selected" : "") }} value="UT">Utah</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "VT" ? "selected" : "") }} value="VT">Vermont</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "VA" ? "selected" : "") }} value="VA">Virginia</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "WA" ? "selected" : "") }} value="WA">Washington</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "WV" ? "selected" : "") }} value="WV">West Virginia</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "WI" ? "selected" : "") }} value="WI">Wisconsin</option>
                    <option {{ (isset($financial_estate[$est_id]['state']) && $financial_estate[$est_id]['state'] == "WY" ? "selected" : "") }} value="WY">Wyoming</option>
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
                <input type='text' value="{{ (isset($financial_estate[$est_id]['zip_code']) ? $financial_estate[$est_id]['zip_code'] : "") }}" class="updatable" name="zip_code" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Present Market Value
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_estate[$est_id]['present_market_value']) ? $financial_estate[$est_id]['present_market_value'] : "") }}" class="updatable" name="present_market_value" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Amount of Mortgages & Liens
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_estate[$est_id]['amount_of_mortgages_and_liens']) ? $financial_estate[$est_id]['amount_of_mortgages_and_liens'] : "") }}" class="updatable" name="amount_of_mortgages_and_liens" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Gross Rental Income
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_estate[$est_id]['gross_rental_income']) ? $financial_estate[$est_id]['gross_rental_income'] : "") }}" class="updatable" name="gross_rental_income" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Mortgage Payment
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_estate[$est_id]['mortgage_payments']) ? $financial_estate[$est_id]['mortgage_payments'] : "") }}" class="updatable" name="mortgage_payments" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Insurance, Maintenance, Taxes & Misc
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_estate[$est_id]['insurance_maintenance_taxes_misc']) ? $financial_estate[$est_id]['insurance_maintenance_taxes_misc'] : "") }}" class="updatable" name="insurance_maintenance_taxes_misc" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Net Rental Income
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($financial_estate[$est_id]['net_rental_income']) ? $financial_estate[$est_id]['net_rental_income'] : "") }}" class="updatable" name="net_rental_income" data-type="financial" data-model="estate" data-sub="{{$est_id}}" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>
@endsection
