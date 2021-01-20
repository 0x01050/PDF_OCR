@extends('smartapp.layout', [
    'back_button' => route('smartapp.start', ['id' => $id]),
    'next_button' => route('smartapp.borrower.address', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="question">
            First Name
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_info_first_name) ? $borrower_info_first_name : "") }}" class="updatable" name="first_name" data-type="borrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Middle Name
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_info_middle_name) ? $borrower_info_middle_name : "") }}" class="updatable" name="middle_name" data-type="borrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Last Name
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_info_last_name) ? $borrower_info_last_name : "") }}" class="updatable" name="last_name" data-type="borrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Social Security Number
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_info_social_security_number) ? $borrower_info_social_security_number : "") }}" class="updatable" name="social_security_number" data-type="borrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Date Of Birth
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_info_date_of_birth) ? $borrower_info_date_of_birth : "") }}" placeholder="mm/dd/yyyy" class="updatable" name="date_of_birth" data-type="borrower" data-model="info" style="width: calc(50% - 50px)" >
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
                <input type='text' value="{{ (isset($borrower_info_home_phone) ? $borrower_info_home_phone : "") }}" class="updatable" name="home_phone" data-type="borrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Work Phone
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_info_work_phone) ? $borrower_info_work_phone : "") }}" class="updatable" name="work_phone" data-type="borrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Email
        </div>
        <div class="answer">
            <div>
                <input type='text' value="{{ (isset($borrower_info_email) ? $borrower_info_email : "") }}" class="updatable" name="email" data-type="borrower" data-model="info" style="width: calc(50% - 50px)" >
            </div>
        </div>
    </div>

    <div class="item-field">
        <div class="question">
            Marital Status
        </div>
        <div class="answer">
            <div>
                <select class="updatable" name="marital_status" data-type="borrower" data-model="info" style="width: calc(50% - 50px)">
                    @if(!isset($borrower_info_marital_status))
                        <option selected disabled value="">Select</option>
                    @endif
                    <option {{ (isset($borrower_info_marital_status) && $borrower_info_marital_status == "married" ? "selected" : "") }} value="married">Married</option>
                    <option {{ (isset($borrower_info_marital_status) && $borrower_info_marital_status == "unmarried" ? "selected" : "") }} value="unmarried">Single</option>
                    <option {{ (isset($borrower_info_marital_status) && $borrower_info_marital_status == "separated" ? "selected" : "") }} value="separated">Separated</option>
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
                <input type='text' value="{{ (isset($borrower_info_years_in_school) ? $borrower_info_years_in_school : "") }}" class="updatable" name="years_in_school" data-type="borrower" data-model="info" style="width: calc(50% - 50px)" >
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
                    <input type='text' value="{{ (isset($borrower_info_number_of_dependents) ? $borrower_info_number_of_dependents : "") }}" class="updatable" name="number_of_dependents" data-type="borrower" data-model="info" style="width: calc(100% - 50px)" >
                </div>
            </div>
        </div>
        <div class="item-field">
            <div class="question">
                Dependent's Ages (separate with commas)
            </div>
            <div class="answer">
                <div>
                    <input type='text' value="{{ (isset($borrower_info_dependent_ages) ? $borrower_info_dependent_ages : "") }}" class="updatable" name="dependent_ages" data-type="borrower" data-model="info" style="width: calc(100% - 50px)" >
                </div>
            </div>
        </div>
    </div>

@endsection
