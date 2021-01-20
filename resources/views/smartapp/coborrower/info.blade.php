@extends('smartapp.layout', [
    'back_button' => route('smartapp.borrower.income', ['id' => $id]),
    'next_button' => route('smartapp.coborrower.address', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="question">
            First Name
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($coborrower_info_first_name) ? $coborrower_info_first_name : "") }}" class="updatable" name="first_name" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Middle Name
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($coborrower_info_middle_name) ? $coborrower_info_middle_name : "") }}" class="updatable" name="middle_name" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Last Name
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($coborrower_info_last_name) ? $coborrower_info_last_name : "") }}" class="updatable" name="last_name" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Social Security Number
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($coborrower_info_social_security_number) ? $coborrower_info_social_security_number : "") }}" class="updatable" name="social_security_number" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Date Of Birth
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($coborrower_info_date_of_birth) ? $coborrower_info_date_of_birth : "") }}" placeholder="mm/dd/yyyy" class="updatable" name="date_of_birth" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <!-- separator -->
    <div style="height: 50px;"></div>

    <div class="item-field">
        <div class="question">
            Home Phone
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($coborrower_info_home_phone) ? $coborrower_info_home_phone : "") }}" class="updatable" name="home_phone" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Work Phone
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($coborrower_info_work_phone) ? $coborrower_info_work_phone : "") }}" class="updatable" name="work_phone" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Email
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($coborrower_info_email) ? $coborrower_info_email : "") }}" class="updatable" name="email" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Marital Status
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="marital_status" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)">
                    <option {{ (!isset($coborrower_info_marital_status) ? "selected" : "") }} disabled value="">Select</option>
                    <option {{ (isset($coborrower_info_marital_status) && $coborrower_info_marital_status == "married" ? "selected" : "") }} value="married">Married</option>
                    <option {{ (isset($coborrower_info_marital_status) && $coborrower_info_marital_status == "unmarried" ? "selected" : "") }} value="unmarried">Single</option>
                    <option {{ (isset($coborrower_info_marital_status) && $coborrower_info_marital_status == "separated" ? "selected" : "") }} value="separated">Separated</option>
                </select>
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Number of Years in School
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($coborrower_info_years_in_school) ? $coborrower_info_years_in_school : "") }}" class="updatable" name="years_in_school" data-type="coborrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="multiple-items">
        <div class="item-field">
            <div class="question">
                Number of Dependents
            </div>
            <div class="answer">
                <div>
                    <input type='text' value="{{ (isset($coborrower_info_number_of_dependents) ? $coborrower_info_number_of_dependents : "") }}" class="updatable" name="number_of_dependents" data-type="coborrower" data-model="info" style="width: calc(100% - 50px)" >
                </div>
            </div>
        </div>
        <div class="item-field">
            <div class="question">
                Dependent's Ages (separate with commas)
            </div>
            <div class="answer">
                <div>
                    <input type='text' value="{{ (isset($coborrower_info_dependent_ages) ? $coborrower_info_dependent_ages : "") }}" class="updatable" name="dependent_ages" data-type="coborrower" data-model="info" style="width: calc(100% - 50px)" >
                </div>
            </div>
        </div>
    </div>

@endsection
