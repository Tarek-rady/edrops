    <script>

        $(document).on("click" , ".add-input-value-wallet", function(e){
            e.preventDefault();
            $(".main-value-wallet").append(
                `
                    <div class="delete-row col-lg-12 row align-items-center">

                        <x-multi-input col="5" main="main-value-wallet" label="{{ __('models.name_ar') }}" name="wallet_ar[]"/>
                        <x-multi-input col="5" main="main-value-wallet" label="{{ __('models.name_en') }}" name="wallet_en[]"/>






                        <div class="col-md-2 col-12 mb-3 mt-4">

                            <div>

                                <button class="btn btn-danger delelte-item-wallet"><i class="mdi mdi-trash-can-outline"></i><button>
                            </div>


                        </div>


                    </div>



                `
            )

        });

        $(document).on('click' , ".delelte-item-wallet" , function(){
            $(this).closest(".delete-row").remove();
        })


    </script>
