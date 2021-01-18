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
                <input type="radio" value="yes" class="updatable" name="has_co_borrower" data-type="start" {{ (isset($start_has_co_borrower) && $start_has_co_borrower == "yes" ? "checked" : "") }}>
                Yes
            </div>
            <div>
                <input type="radio" value="no" class="updatable" name="has_co_borrower" data-type="start" {{ (isset($start_has_co_borrower) && $start_has_co_borrower == "no" ? "checked" : "") }}>
                No
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('input[name="has_co_borrower"]').change(function(event) {
                field_value = $(event.target).val();
                if(field_value == "yes")
                    $("#co-borrower-menu").show();
                else
                    $("#co-borrower-menu").hide();
            });
        });
    </script>
@endpush
