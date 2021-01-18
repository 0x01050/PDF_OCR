@extends('smartapp.layout', [
    'no_finish' => true
])

@push('css')
    <style>
        .big-alert
        {
            font-size: 1.8em;
            text-align: center;
        }
    </style>
@endpush

@section('smartapp-content')
    <div class="big-alert">
        You have successfully submitted the application!
    </div>
    <div class="footer_logo">
        <img src="/img/finish.png" width="36">
    </div>
@endsection
