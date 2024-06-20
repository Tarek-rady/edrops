<div class="row">
    <div class="col-lg-12">
        {{-- cart name  --}}
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <x-forms label="{{ __('models.name_ar') }}" name="name_ar" :value="$product ? $product->name_ar : ''"/>
                    <x-forms label="{{ __('models.name_en') }}" name="name_en" :value="$product ? $product->name_en : ''"/>
                    @if ($product != null)
                        <input type="hidden" name="id" id="id" value="{{ $product->id }}">
                        <x-forms label="{{ __('models.sku') }}" name="sku" :value="$product ? $product->sku : ''"/>

                    @endif
                    <!-- end col -->
                </div>
            </div>
        </div>
        {{--  end card  --}}


        {{-- cart select  --}}
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <x-select label="{{ __('models.categories') }}" name="category_id" :options="$categories->pluck('name' , 'id')" :value="$product ? $product->category : '' "/>
                    <x-select label="{{ __('models.brands') }}"     name="brand_id"    :options="$brands->pluck('name' , 'id')"     :value="$product ? $product->brand : '' "/>
                    <x-select label="{{ __('models.countries') }}"  name="country_id" :options="$countries->pluck('name' , 'id')"   :value="$product ? $product->country : '' "/>
                    <x-select label="{{ __('models.stocks') }}"     name="stock_id" :options="[]"        :value="$product ? $product->store : '' "/>
                        @if ($product != null)

                            <div class="col-lg-6">
                                <label class="form-label" for="meta-keywords-input">{{ __('models.sallers') }}</label>
                                <select class="form-control js-example-basic-multiple" name="sallers[]" id="sallers" multiple>
                                    <option value="" > {{ __('models.sallers') }} </option>
                                    @if ($product->type == 'public')
                                        @foreach ( $sallers as $saller )
                                            <option value="{{ $saller->id }}">{{ $saller->name }}</option>
                                        @endforeach
                                    @else

                                    @foreach ( $sallers as $saller )
                                        <option value="{{ $saller->id }}" @foreach ($product->view_sallers as $product_saller)
                                            {{ $product_saller->saller_id == $saller->id ? 'selected' : ''  }}
                                        @endforeach >{{ $saller->name }}</option>
                                    @endforeach

                                    @endif
                                </select>
                            </div>
                        @else
                            <x-multi-select label="{{ __('models.sallers') }}"    name="sallers" :options="$sallers->pluck('name' , 'id')" />
                        @endif

                </div>
            </div>
        </div>
        {{--  end card  --}}



        {{--  card images  --}}
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Product Gallery</h5>
            </div>
            <div class="card-body">
                <x-image label="{{ __('img') }}" name="img" :value="$product ? $product->img : '' "/>

                {{--  images  --}}
                <x-images label="{{ __('img') }}" name="images" :value="$product ? $product->img : '' "/>

        </div>
        {{--  end card  --}}



        {{-- card video  --}}
        <div class="card">
            <div class="card-body">
                <x-vedio />
            </div>
        </div>
        {{--  end card  --}}


        {{--  card product details  --}}
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                    <x-item active="true" id="product-details" label="{{ __('models.product_details') }}"/>
                    <x-item  id="product-sizes" label="{{ __('models.sizes') }}"/>
                    <x-item  id="product-colors" label="{{ __('models.colors') }}"/>
                    <x-item  id="product-comment" label="{{ __('models.use_product') }}"/>
                    <x-item  id="product-desc" label="{{ __('models.desc') }}"/>
                    <x-item  id="product-note" label="{{ __('models.note') }}"/>
                    <x-item  id="product-populer" label="{{ __('models.populer') }}"/>
                    <x-item  id="product-adv" label="{{ __('models.adv') }}"/>
                    <x-item  id="product-rates" label="{{ __('models.rates') }}"/>
                    <x-item  id="product-links" label="{{ __('models.links') }}"/>
                </ul>
            </div>
            <!-- end card header -->


            <div class="card-body">
                <div class="tab-content">

                    <x-pane active="true" id="product-details" num="1">

                        <div class="row">

                            <input type="hidden" name="profit_app" id="profit_app" value="{{ $setting->profit_app }}">
                            <input type="hidden" name="profit_saller" id="profit_saller" value="{{ $setting->profit_saller }}">
                            <input type="hidden" name="min_setting" id="min_setting" value="{{ $setting->min }}">
                            <input type="hidden" name="max_setting" id="max_setting" value="{{ $setting->max }}">

                            <x-forms col="3" label="{{__('models.cost_user')}}" name="cost_user" :value="$product ? $product->cost_user : '' " span="true"/>
                            <x-forms col="3" label="{{__('models.cost')}}" name="cost" :value="$product ? $product->cost : '' "                span="true"/>
                            <x-forms col="3" label="{{__('models.price')}}" name="price" :value="$product ? $product->price : '' "             span="true"/>
                            <x-forms col="3" label="{{__('models.profit')}}" name="profit" :value="$product ? $product->profit : '' "          span="true"/>

                            {{--  min , max  --}}
                            <div class="mt-4 pt-2">
                                <div class="row gy-4">
                                    <x-quantity label="{{ __('models.min') }}" name="min" :value="$product ? $product->min : '' "/>
                                    <x-quantity label="{{ __('models.max') }}" name="max" :value="$product ? $product->max : '' " :light="true"/>
                                </div>
                                <!-- end row -->
                            </div>

                            <x-forms type="number" col="4" label="{{__('models.qty')}}" name="qty" :value="$product ? $product->qty : '' "             span="true"/>
                            <x-forms type="number" col="4" label="{{__('models.stock')}}" name="stock" :value="$product ? $product->stock : '' "             span="true"/>
                            <x-forms type="number" col="4" label="{{__('models.discount')}}" name="discount" :value="$product ? $product->discount : '' "             span="true"/>






                        </div>



                    </x-pane>


                    <x-pane  id="product-sizes" num="2">
                        <x-button label="{{ __('models.add_sizes') }}" name="size" color="danger">

                            @if (isset($product->sizes))
                                @foreach ( $product->sizes as $size)

                                <div class="delete-row col-lg-12 row">

                                        <x-multi-input col="4" main="main-value-size" label="{{ __('models.size_ar') }}" name="size_ar[]" :value="$size->size_ar"/>
                                        <x-multi-input col="4" main="main-value-size" label="{{ __('models.size_en') }}" name="size_en[]" :value="$size->size_en"/>
                                        <x-multi-input col="2" main="main-value-size" label="{{ __('models.code') }}" name="code_size[]"  :value="$size->code_size"/>

                                        <div class="col-md-2 col-12 mb-3 mt-4">
                                            <div>
                                                <button class="btn btn-danger delelte-item-size"><i class="mdi mdi-trash-can-outline"></i><button>
                                            </div>
                                        </div>
                                </div>

                                @endforeach

                            @endif



                        </x-button>
                    </x-pane>



                    <x-pane  id="product-colors" num="3">
                        <x-button label="{{ __('models.add_colors') }}" name="color" color="primary">

                            @if (isset($product->colors))
                                @foreach ( $product->colors as $color)

                                <div class="delete-row col-lg-12 row">

                                        <x-multi-input col="4" main="main-value-color" label="{{ __('models.color_ar') }}" name="color_ar[]" :value="$color->color_ar"/>
                                        <x-multi-input col="4" main="main-value-color" label="{{ __('models.color_en') }}" name="color_en[]" :value="$color->color_en"/>
                                        <x-multi-input col="2" main="main-value-color" label="{{ __('models.code') }}" name="code_color[]"  :value="$color->code_color"/>

                                        <div class="col-md-2 col-12 mb-3 mt-4">
                                            <div>
                                                <button class="btn btn-danger delelte-item-color"><i class="mdi mdi-trash-can-outline"></i><button>
                                            </div>
                                        </div>
                                </div>

                                @endforeach

                            @endif



                        </x-button>


                    </x-pane>

                    <x-pane  id="product-comment" num="4">
                        <x-textarea label="{{ __('models.use_product_ar') }}" name="use_product_ar" :value="$product ? $product->use_product_ar : '' " />
                        <x-textarea label="{{ __('models.use_product_en') }}" name="use_product_en" :value="$product ? $product->use_product_en : '' " />
                    </x-pane>

                    <x-pane  id="product-desc" num="5">
                        <x-textarea label="{{ __('models.desc_ar') }}" name="desc_ar" :value="$product ? $product->desc_ar : '' " />
                        <x-textarea label="{{ __('models.desc_en') }}" name="desc_en" :value="$product ? $product->desc_en : '' " />
                    </x-pane>

                    <x-pane  id="product-note" num="6">
                        <x-textarea label="{{ __('models.note_ar') }}" name="note_ar" :value="$product ? $product->note_ar : '' " />
                        <x-textarea label="{{ __('models.note_en') }}" name="note_en" :value="$product ? $product->note_en : '' " />
                    </x-pane>

                    <x-pane  id="product-populer" num="7">
                        <x-textarea label="{{ __('models.populer_ar') }}" name="populer_ar" :value="$product ? $product->populer_ar : '' " />
                        <x-textarea label="{{ __('models.populer_en') }}" name="populer_en" :value="$product ? $product->populer_en : '' " />
                    </x-pane>

                    <x-pane  id="product-adv" num="8">
                        <x-textarea label="{{ __('models.adv_ar') }}" name="adv_ar" :value="$product ? $product->adv_ar : '' " />
                        <x-textarea label="{{ __('models.adv_en') }}" name="adv_en" :value="$product ? $product->adv_en : '' " />
                    </x-pane>



                    <x-pane  id="product-rates" num="9">
                        <div class="row">
                            <x-forms col="4" type="number" label="{{__('models.ratio')}}" name="ratio" :value="$product ? $product->ratio : '' " span="true"/>
                            <x-forms col="4" type="number" label="{{__('models.delivery')}}" name="delivery" :value="$product ? $product->delivery : '' " span="true"/>
                            <x-forms col="4" type="number" label="{{__('models.competition')}}" name="competition" :value="$product ? $product->competition : '' " span="true"/>
                        </div>
                    </x-pane>

                    <x-pane  id="product-links" num="10">
                        <div class="row">
                            <x-inputs  name="youtube" :value="$product ? $product->youtube : '' "  i="ri-youtube-fill" color="danger"/>
                            <x-inputs  name="amazon" :value="$product ? $product->amazon : '' "    i="ri-amazon-fill"  color="primary"/>
                        </div>
                    </x-pane>


                </div>






                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </div>
            <!-- end card body -->
        </div>
        {{--  end card  --}}
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm">Submit</button>
        </div>
    </div>
    <!-- end col -->


    <!-- end col -->
</div>
<!-- end row -->
