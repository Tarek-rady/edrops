    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>

    <script>
        function openModal(modal, desc, productId) {

            if(desc != null){
                $(modal + ' .modal-body p').text(desc);
            }
            if(productId != null){
                $(modal + ' .modal-body input[name="product_id"').val(productId);
            }

            $(modal).modal('show');
            $(modal).css('backdrop-filter', 'blur(5px)');
            $('.modal-backdrop').last().css('z-index', '1055');

        }
        var currentSortOrder = {
            'created_at': 'desc',
            'price': 'desc'
        };
        var filters= {
            page: 1
        };

        function filterBySearch(){
            var searchVal = $('input[name="search"]').val();
            if(searchVal.trim() !== ''){
                filters['search_query'] = searchVal;
            }else{
                delete filters.search_query;
            }

            makeFilterRequest(filters);
        }
        function filterByCategory(category) {
            filters['category'] = category;

            makeFilterRequest(filters);
        }
        function filterByCountry(country) {
            filters['country'] = country;

            makeFilterRequest(filters);
        }
        function sortBy(sortField) {
            var previousFilterType = Object.keys(currentSortOrder).find(key => currentSortOrder[key] !== 'desc');
            if (previousFilterType && previousFilterType !== sortField) {
                currentSortOrder[previousFilterType] = 'desc';
            }

            if (sortField === 'price' || sortField === 'created_at') {
                currentSortOrder[sortField] = (currentSortOrder[sortField] === 'desc') ? 'asc' : 'desc';
            }

            if (!filters.sort) {
                filters.sort = {};
            }
            filters.sort.sort_field  = sortField;
            filters.sort.sort  = currentSortOrder[sortField];

            makeFilterRequest(filters);
        }
        function removeFilter(filter_field) {
            delete filters[filter_field];
            makeFilterRequest(filters);
        }
        function applied_filters(filters) {
            Object.keys(filters).forEach(function(key) {
                var value = filters[key];
                if(key == 'sort'){
                    var sort_field = filters[key]['sort_field'] == 'created_at' ? 'الاحدث' : 'السعر';
                    var sort = filters[key]['sort'];
                    $(".filters-applied .sort-field").remove();
                    $(".filters-applied").append(`
                        <div class="sorting sort-field">
                            <span>${sort_field}</span>
                            <i class="ri-arrow-${sort == 'asc' ? 'up' : 'down'}-line"></i>
                            <i class="ri-close-line" style="float:left" onclick="removeFilter('sort')"></i>
                        </div>
                    `);
                }else if(key == 'country' || key == 'category'){
                    var value = $(`.${key}-dropdown > #${filters[key]} > span`).text();
                    $(".filters-applied").append(`
                        <div class="sorting">
                            <span>${value}</span>
                            <i class="ri-close-line" style="float:left" onclick="removeFilter('${key}')"></i>
                        </div>
                    `);
                }else{
                    $(".filters-applied").empty();
                }
            });
        }
        function paginate(page){
            filters['page'] = page;

            makeFilterRequest(filters);
        }
        function makeFilterRequest(data) {

            // Show loader
            $('#loader-overlay').show();

            $.ajax({
                type: 'GET',
                url: '{{ route('saller.filter.products') }}',
                data: data,
                success: function(response) {
                    // Hide loader
                    $('#loader-overlay').hide();
                    filters = response.filters;
                    applied_filters(filters);
                    $('#productList').html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error(error);

                    // Hide loader
                    $('#loader-overlay').hide();
                }
            });
        }
        function add_to_my_products(product_id){

            // Show loader
            $('#loader-overlay').show();

            var url = "{{ route('saller.product.add', ":id") }}";
            url = url.replace(':id', product_id);

            $.ajax({
                type: 'POST',
                url: url,
                data:{
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Hide loader
                    $('#loader-overlay').hide();
                    if(response.success){
                        $('.alert-message.success p').text(response.message)
                        $('.alert-message.success').show();
                        setTimeout(function() {
                            $('.alert-message.success').hide();
                        }, 2000);
                    }else{
                        $('.alert-message.error p').text(response.message)
                        $('.alert-message.error').show();
                        setTimeout(function() {
                            $('.alert-message.error').hide();
                        }, 2000);
                    }

                },
                error: function(xhr, status, error) {
                    console.error(error);

                    // Hide loader
                    $('#loader-overlay').hide();
                }
            });

        }

        // Function to download images as a zip file
        async function downloadMediaAsZip(type, mediaUrls, productName, button) {

            const image = button.querySelector('#downloadMedia');
            button.disabled = true;

            image.src = "{{ asset('img/loader.gif') }}";
            image.style.width = "30px";
            image.style.height = "30px";

            const zip = new JSZip();

            if(type == 'images'){

                const imageUrls = JSON.parse(mediaUrls);

                await Promise.all(imageUrls.map(async (url, index) => {
                    const response = await fetch(url);
                    const arrayBuffer = await response.arrayBuffer();
                    zip.file(`${productName}.jpg`, arrayBuffer);
                }));

            }else{
                const response = await fetch(mediaUrls);
                const blob = await response.blob();
                zip.file(`${productName}.mp4`, blob);
            }


            zip.generateAsync({ type: 'blob' })
                .then(blob => {
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = productName+'.zip';
                    link.click();

                    setTimeout(() => {
                        button.disabled = false;
                        image.src = "{{ asset('img/cloud_download.png') }}";
                        image.style.width = "20px";
                        image.style.height = "20px";
                    }, 1000);
            });
        }

        function rateProduct(button) {
            var modal = document.getElementById('commentModal');
            var productId = modal.querySelector('input[name="product_id"]').value;
            var msg = modal.querySelector('#msg').value;
            var ratingInput = modal.querySelector('input[name="rating"]:checked');
            var rating = ratingInput ? ratingInput.id.split('-')[1] : null;
            $('#loader-overlay').show();

            $.ajax({
                type: 'POST',
                url: "{{route('saller.product.rate')}}",
                data: {
                    _token : '{{ csrf_token() }}',
                    product_id: productId,
                    msg: msg,
                    rate: rating
                },
                success: function(response) {
                    if(response.success){
                        $('#loader-overlay').hide();
                        handleSuccessResponse(response);
                        $(modal).modal('hide');
                    }else{
                        $('#loader-overlay').hide();
                        handleErrorResponse(response);
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader-overlay').hide();
                    handleErrorResponse({ message: "Error occurred during AJAX request: " + error });
                }
            });

        }

        $('#commentModal').on('hidden.bs.modal', function () {
            $(this).find('input[name="rating"]').prop('checked', false);
            $(this).find('textarea[name="msg"]').val('');
        });

        function handleSuccessResponse(response) {
            $('.alert-message.success p').html(response.message.replace(/\n/g, '<br>'));
            $('.alert-message.success').show();
            setTimeout(function() {
                $('.alert-message.success').hide();
            }, 2000);
        }
        function handleErrorResponse(response) {
            $('.alert-message.error p').html(response.message.replace(/\n/g, '<br>'));
            $('.alert-message.error').show();
            setTimeout(function() {
                $('.alert-message.error').hide();
            }, 2000);
        }
    </script>
