@extends('smartapp.layout', [
    'next_button' => route('smartapp.borrower.info', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="question">
            Does this application have a co-borrower?
        </div>
        <div class="answer">
            <div>
                <input type="radio" value="yes" class="updatable" name="has_co_borrower" data-type="start" {{ (isset($start_has_co_borrower) && $start_has_co_borrower == "yes" ? "checked" : "") }} data-on="yes" data-target="#co-borrower-menu">
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="has_co_borrower" data-type="start" {{ (isset($start_has_co_borrower) && $start_has_co_borrower == "no" ? "checked" : "") }} data-on="yes" data-target="#co-borrower-menu">
                No
            </div>
        </div>
    </div>
@endsection
