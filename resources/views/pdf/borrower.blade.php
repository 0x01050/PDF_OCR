@extends('layout.app', ['title' => 'Borrower Docusign'])

@section('content')
    <input type="hidden" id="leads_token" value="<?php echo csrf_token(); ?>">
    <div>
        <label>Borrower Name: </label>
        <input type="text" name="borrower" id="borrower" />
    </div>
    <div>
        <label>Borrower Email: </label>
        <input type="email" name="borrower_email" id="borrower_email" />
    </div>
    <div>
        <label>Co-Borrower Name: </label>
        <input type="text" name="coborrower" id="coborrower" />
    </div>
    <div>
        <label>Co-Borrower Email: </label>
        <input type="email" name="coborrower_email" id="coborrower_email" />
    </div>
    <input type='file' name='leads' id="leads_upload" data-url="{{ route('borrower-import') }}"/>
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
            $leads.bind('fileuploadsubmit', function (e, data) {
                // The example input, doesn't have to be part of the upload form:
                var borrower = $('#borrower');
                var borrower_email = $('#borrower_email');
                var coborrower = $('#coborrower');
                var coborrower_email = $('#coborrower_email');
                data.formData = {
                    borrower: borrower.val(),
                    borrower_email: borrower_email.val(),
                    coborrower: coborrower.val(),
                    coborrower_email: coborrower_email.val(),
                };
                if (!data.formData.borrower) {
                    borrower.focus();
                    return false;
                }
                if (!data.formData.borrower_email) {
                    borrower_email.focus();
                    return false;
                }
                return true;
            });
            $leads.fileupload({
                dataType: "json",
                add: function(e, data) {
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
                        $("#upload_progress").text(data.result.message);
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
