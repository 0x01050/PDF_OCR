@extends('layout.app', ['title' => 'Scan PDF'])

@section('content')
    <input type="hidden" id="leads_token" value="<?php echo csrf_token(); ?>">
    <input type='file' name='leads' id="leads_upload" data-url="{{ route('import') }}"/>
    <label id="upload_progress">Ready for scan</label>
    <a id="download_link" href="" style="display: none;">Download Result</a>
@endsection

@push('js')
    <script src="{{ asset('jQuery-File-Upload') }}/jquery.ui.widget.js"></script>
    <script src="{{ asset('jQuery-File-Upload') }}/jquery.fileupload.js"></script>
    <script>
        var LeadsImport = (function() {

        // Variables
        var $leads = $('#leads_upload');

        // Methods
        function init($leads) {
            $leads.fileupload({
                dataType: "json",
                add: function(e, data) {
                    $("#download_link").css('display', 'none');
                    $("#upload_progress").text("0% ...");
                    data.submit();
                },
                progress: function(e, data) {
                    var progress = parseInt((data.loaded / data.total) * 100, 10);
                    if(progress == 100) {
                        $("#upload_progress").text("Scanning ...");
                    } else {
                        $("#upload_progress").text(progress + "% Uploaded ...");
                    }
                },
                done: function(e, data) {
                    if(data.result.result == 'success') {
                        $("#download_link").css('display', 'inherit');
                        $("#download_link").attr('href', data.result.link);
                        $("#upload_progress").text(data.result.message + '\n' + 'Loan Officer : ' + data.result.officer);
                    }
                    else if(data.result.result == 'error') {
                        $("#upload_progress").text(data.result.message + '\n' + data.result.trace);
                    } else {
                        $("#upload_progress").text(data.result.message);
                    }
                },
                fail: function (e, data) {
                    $("#upload_progress").text("Failed");
                },
                headers: {
                    'X-CSRF-Token': $("#leads_token").val()
                }
            });
        };

        // Events
        if ($leads.length) {
            init($leads);
        }

        })();
    </script>
@endpush
