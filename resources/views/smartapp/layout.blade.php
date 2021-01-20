@extends('layout.app', ['title' => 'SmartApp 1003'])

@push('css')
    <style>
        .smartapp-body
        {
            flex: 1;
            background-color: white;
            width: 750px;
        }
        @media (min-width: 992px)
        {
            .smartapp-body
            {
                width: 970px;
            }
        }
        .smartapp-content
        {
            padding: 35px;
        }
        .smartapp-title
        {
            font-size: 1.8em;
            color: #5bc0de;
        }

        .multiple-items
        {
            display: flex;
            flex-direction: row;
        }
        .item-field
        {
            flex: 1;
        }
        .item-field .question
        {
        }
        .item-field .description
        {
            margin-bottom: 20px;
        }
        .item-field .divider
        {
            font-size: 20px;
            margin: 20px 0;
            border-bottom: 1px solid #e5e5e5;
        }
        .answer input[type="text"],
        .answer select
        {
            margin: 5px 0;
            padding: 5px 12px;
            font-size: 16px;

            border: 1px solid black;
            box-sizing: content-box;
        }
        .answer input[type="checkbox"]
        {
            margin: 20px 0;
        }
        .alert
        {
            padding: 15px;
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
            border-radius: 4px;
            margin-top: 20px;
        }
        .list_items
        {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
        }
        .list_item
        {
            padding: 10px 15px;
            border: 1px solid #ddd;
            margin-bottom: -1px;
        }
        .list_item:hover
        {
            color: #555;
            text-decoration: none;
            background-color: #f5f5f5;
        }
        .list_buttons
        {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .list_button
        {
            padding: 6px 12px;
            color: #fff;
            background-color: #204d74;
            border-color: #122b40;
            border-radius: 4px;
        }
        .smartapp-buttons
        {
            display: flex;
            justify-content: space-evenly;
            padding: 20px;
            margin-bottom: 40px;
        }
        .smartapp-button
        {
            padding: 10px 16px;
            font-size: 18px;
            width: 250px;
            text-align: center;
            cursor: pointer;
            user-select: none;
            border-radius: 4px;
            box-shadow: 0 1px 1px 0 #000000bf;
        }
        .smartapp-button:active
        {
            box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
        }
        .back_button:hover
        {
            color: #000;
            background-color: #e6e6e6;
            border-color: #adadad;
        }
        .finish_button
        {
            font-size: 18px;
            padding: 10px 0;
            text-align: center;
            cursor: pointer;
            user-select: none;
        }
        .remove_button
        {
            color: #fff;
            background-color: #d9534f;
        }
        .remove_button:hover
        {
            background-color: #c9302c;
            border-color: #ac2925;
        }
        .remove_button:active
        {
            background-color: #c9302c;
            border-color: #ac2925;
        }
        .next_button
        {
            color: #fff;
            background-color: #5bc0de;
            border-color: #1b6d85;
        }
        .smartapp-content table
        {
            border: 1px solid #ddd;
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-spacing: 0;
        }
        .smartapp-content table th,
        .smartapp-content table td
        {
            border: 1px solid #ddd;
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
        }
        .footer_logo
        {
            text-align: center;
        }
    </style>
@endpush
@section('content')
    @include('smartapp.menu.top')
    <div class="smartapp-body mt-8">
        @if(isset($bottom))
            @include('smartapp.menu.bottom')
        @endif
        <div class="smartapp-content">
            <h3 class="smartapp-title">{{ $subtitle }}</h3>
            <input type="hidden" id="csrf_token" value="<?php echo csrf_token(); ?>">
            @yield('smartapp-content')
        </div>
        <div class="smartapp-buttons">
            @if(isset($back_button))
                <a class="smartapp-button back_button" href="{{$back_button}}">
                    < Back
                </a>
            @endif

            @if(isset($remove_button))
                <a class="smartapp-button remove_button" href="{{$remove_button}}">
                    Remove this listing
                </a>
            @elseif(!isset($no_finish))
                <a class="underline finish_button" href="{{route('smartapp')}}">
                    Save & Finish later
                </a>
            @endif
            @if(isset($next_button))
                <a class="smartapp-button next_button" href="{{$next_button}}">
                    Save & Continue >
                </a>
            @endif
        </div>
        <div class="footer_logo">
            <img src="/img/footer_logo.jpg">
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('#csrf_token').val()
                }
            });
            $('.updatable').change(function(event) {
                field_type = $(event.target).data('type');
                field_model = $(event.target).data('model');
                field_sub = $(event.target).data('sub');
                field_name = $(event.target).attr('name');

                input_type = $(event.target).attr('type');
                if(input_type == 'checkbox')
                    field_value = $(event.target).is(':checked');
                else
                    field_value = $(event.target).val();

                on = $(event.target).data('on');
                if(on !== undefined) {
                    target = $(event.target).data('target');
                    if(field_value == on)
                        $(target).show();
                    else
                        $(target).hide();
                }

                $.post("{{ route('smartapp.update', ['id' => $id]) }}",
                    {
                        type: field_type,
                        model: field_model,
                        sub: field_sub,
                        name: field_name,
                        value: field_value
                    },
                    function(response) {
                        console.log(response);
                    }
                );
            });
        });
    </script>
@endpush
