@extends('layout.app', ['title' => 'SmartApp 1033'])

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf-6.4.3/dt-1.10.23/r-2.2.7/datatables.min.css"/>
@endpush

@section('content')
    <input type="hidden" id="leads_token" value="<?php echo csrf_token(); ?>">
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
        $(document).ready(function() {
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
                    { data: 'created_at', orderable: false, width: 250 },
                    { data: 'updated_at', orderable: false, width: 250 },
                    { data: 'submitted_at', orderable: false, width: 250,
                        render: function ( data, type, row ) {
                            if(!row['submitted_at'])
                                return 'Not Submitted Yet';
                            return row['submitted_at'];
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
