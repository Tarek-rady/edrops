    <script>
        $(document).ready(function () {
            $('#country_id').on('change', function () {
                var country_id = $(this).val();
                if (country_id) {
                    $.ajax({
                        url: "{{ URL::to('admin/country-stocks') }}/" + country_id
                        , type: "GET"
                        , dataType: "json"
                        , success: function (data) {
                            $('#stock_id').empty();

                            $.each(data, function (key, value) {
                                $('#stock_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                        ,
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
