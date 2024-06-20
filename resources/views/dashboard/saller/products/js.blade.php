    <script>

        $(document).ready(function() {
            $(document).on('input', '#price', function() {
                var price = parseFloat($('#price').val()) || 0; // يضمن أنه إذا لم يتم إدخال قيمة، فإن القيمة ستكون 0
                var cost = parseFloat($('#cost').val()) || 0;

                var profit = price - cost;

                $('#profit').val(parseFloat(profit));
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.3/resumable.min.js" integrity="sha512-OmtdY/NUD+0FF4ebU+B5sszC7gAomj26TfyUUq6191kbbtBZx0RJNqcpGg5mouTvUh7NI0cbU9PStfRl8uE/rw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('admin.upload.file') }}',
            query: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            }, // CSRF token
            fileType: ['mp4', 'flv', 'm3u8', 'ts', '3gp', 'mov', 'avi', 'wmv', 'MP4' , 'FLV' , 'M3U8' , 'TS' , '3GP' , 'MOV' , 'AVI' , 'WMV'],
            chunkSize: 10 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function(file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function(file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            $('#videoPreview').attr('src', response.path);
            $('.card-footer').show();
        });

        resumable.on('fileError', function(file, response) { // trigger when there is any error
            console.log(response);
            // alert('file uploading error.')
        });


        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>
