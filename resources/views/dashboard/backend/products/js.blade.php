
    <script>

        // ======================================== Add size =========================================================
        $(document).on("click" , ".add-input-value-size", function(e){
            e.preventDefault();
            $(".main-value-size").append(
                `
                    <div class="delete-row col-lg-12 row align-items-center">

                        <x-multi-input col="4" main="main-value-size" label="{{ __('models.size_ar') }}" name="size_ar[]"/>
                        <x-multi-input col="4" main="main-value-size" label="{{ __('models.size_en') }}" name="size_en[]"/>
                        <x-multi-input col="2" main="main-value-size" label="{{ __('models.code') }}" name="code_size[]"/>






                        <div class="col-md-2 col-12 mb-3 mt-4">

                            <div>

                                <button class="btn btn-danger delelte-item-size"><i class="mdi mdi-trash-can-outline"></i><button>
                            </div>


                        </div>


                    </div>



                `
            )

        });

        $(document).on('click' , ".delelte-item-size" , function(){
            $(this).closest(".delete-row").remove();
        })
        // ======================================== Add Color =========================================================
        $(document).on("click" , ".add-input-value-color", function(e){
            e.preventDefault();
            $(".main-value-color").append(
                `
                    <div class="delete-row col-lg-12 row align-items-center">

                        <x-multi-input col="4" main="main-value-color" label="{{ __('models.color_ar') }}" name="color_ar[]"/>
                        <x-multi-input col="4" main="main-value-color" label="{{ __('models.color_en') }}" name="color_en[]"/>
                        <x-multi-input col="2" main="main-value-color" label="{{ __('models.code') }}" name="code_color[]"/>






                        <div class="col-md-2 col-12 mb-3 mt-4">

                            <div>

                                <button class="btn btn-danger delelte-item-color"><i class="mdi mdi-trash-can-outline"></i><button>
                            </div>


                        </div>


                    </div>



                `
            )

        });

        $(document).on('click' , ".delelte-item-color" , function(){
            $(this).closest(".delete-row").remove();
        })


    </script>


    <script>

        $(document).ready(function() {
            $(document).on('input', '#cost_user', function() {

                var cost_user = parseFloat($('#cost_user').val()) || 0;
                var profit_app = parseFloat($('#profit_app').val()) || 0;
                var min_setting = parseFloat($('#min_setting').val()) || 0;
                var max_setting = parseFloat($('#max_setting').val()) || 0;
                var profit_saller = parseFloat($('#profit_saller').val()) || 0;

                var new_cost  =  cost_user * profit_app / 100 +  cost_user;
                var new_price =  new_cost * profit_saller / 100 + new_cost ;
                var profit = new_price - new_cost ;
                $('#cost').val(parseFloat(new_cost));
                $('#price').val(parseFloat(new_price));
                $('#profit').val(parseFloat(profit).toFixed(2));
                $('#min').val(parseFloat(new_price + min_setting).toFixed(2));
                $('#max').val(parseFloat(new_price + max_setting).toFixed(2));


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
