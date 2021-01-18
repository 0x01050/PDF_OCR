@extends('layout.app', ['title' => 'SmartApp 1003'])

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf-6.4.3/dt-1.10.23/r-2.2.7/datatables.min.css"/>
@endpush

@push('css')
    <style>
        #new_app_name
        {
            height: 34px;
            border-radius: 3px;
            padding-left: 10px;
            font-size: 14px;
            line-height: 1.42857143;
            border: 1px solid #BDC4C9;
            box-shadow: inset 0px 1px 0px #F1F0F1;
        }
        #new_app_button
        {
            background-color: #26a65b;
            color: #fff;
            font-size: 14px;
            padding: 7px 20px 7px 20px;
            border: none;
            border-radius: 3px;
            line-height: 1.42857143;
            cursor: pointer;
        }
        #new_app_button:hover
        {
            background-color: #2ab764;
        }
        #new_app_button:active
        {
            background: #219150;
            box-shadow: none;
            outline:none;
        }
    </style>
@endpush

@section('content')
    <input type="hidden" id="leads_token" value="<?php echo csrf_token(); ?>">
    <div style="margin-bottom: 20px;">
        <input id="new_app_name">
        <button id="new_app_button">Start New Application</button>
        <a id="new_app_link" style="display:none"></a>
    </div>
    <table id="app_table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Application Name</th>
                <th>Started On</th>
                <th>Last Updated</th>
                <th>Date Submitted</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
@endsection

@push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/zf-6.4.3/dt-1.10.23/r-2.2.7/datatables.min.js"></script>
    <script>
        function localize(t) {
            var d = new Date(t + " UTC");
            return d.toLocaleString();
        }
        function parseiso(t) {
            var d = new Date(t);
            return d.toLocaleString();
        }
        $(document).ready(function() {
            $("#new_app_button").click(function() {
                var new_name = $("#new_app_name").val();
                if(new_name) {
                    $("#new_app_link").attr('href', '/smartapp/create/' + new_name);
                    $("#new_app_link")[0].click();
                } else {
                    $("#new_app_name").focus();
                }
            });
            $('#app_table').DataTable( {
                columns: [
                    { data: 'id', visible: false },
                    { data: 'name', orderable: false, width: 150,
                        render: function ( data, type, row ) {
                            return `
                                <a href='/smartapp/edit/${row['id']}' class='underline'>${row['name']}</a>
                            `;
                        }
                    },
                    { data: 'created_at', orderable: false, width: 250,
                        render: function ( data, type, row ) {
                            return parseiso(row['created_at']);
                        }
                    },
                    { data: 'updated_at', orderable: false, width: 250,
                        render: function ( data, type, row ) {
                            return parseiso(row['updated_at']);
                        }
                    },
                    { data: 'submitted_at', orderable: false, width: 250,
                        render: function ( data, type, row ) {
                            if(!row['submitted_at'])
                                return 'Not Submitted Yet';
                            return localize(row['submitted_at']);
                        }
                    },
                    { data: null, orderable: false, width: 100,
                        render: function ( data, type, row ) {
                            return `
                                <div>
                                    <a href='/smartapp/fnm/${row['id']}?_=${Date.now()}' class='btn btn-success actionTooltip' data-placement='bottom' title='' data-original-title='Download FNM 3.2'><i class='fa fa-file-text-o'></i>&nbsp;FNM</a>
                                    <a href='/smartapp/pdf/${row['id']}?_=${Date.now()}' class='actionTooltip' data-placement='bottom' title='' data-original-title='Download PDF'><img src='/img/pdf_icon.png'></a>
                                </div>
                            `;
                        }
                    }
                ],
                ajax: "{{ route('smartapp.get') }}",
                responsive: true,
                bFilter: false
            } );
        } );
    </script>
@endpush
