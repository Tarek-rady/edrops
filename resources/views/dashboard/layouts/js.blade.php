  <!-- JAVASCRIPT -->
<script src="{{ asset('dashboard/assets/js/jquery-3.7.1.min.js')}}"></script>

<script src="{{ asset('dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/plugins.js')}}"></script>





<!-- ckeditor -->
<script src="{{ asset('dashboard/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

<!-- dropzone js -->
<script src="{{ asset('dashboard/assets/libs/dropzone/dropzone-min.js')}}"></script>

<script src="{{ asset('dashboard/assets/js/pages/ecommerce-product-create.init.js')}}"></script>



<script src="{{ asset('dashboard/assets/js/pages/modal.init.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/app.js')}}"></script>



<script src="{{ asset('dashboard/assets/libs/prismjs/prism.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/pages/form-validation.init.js')}}"></script

<script src="{{ asset('dashboard/assets/libs/list.js/list.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/libs/list.pagination.js/list.pagination.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/pages/listjs.init.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/cdn.datatables.net_1.13.6_js_jquery.dataTables.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('dashboard/assets/js/pages/select2.init.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
        $('.summernote').summernote({
            placeholder: 'يرجي ادخال الوصف',
            tabsize: 2,
            height: 200,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        </script>

@yield('js')


