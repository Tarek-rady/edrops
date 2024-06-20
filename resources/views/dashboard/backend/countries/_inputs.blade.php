


<x-forms label="{{ __('models.name_ar') }}" col="4" name="name_ar" :value="$country ? $country->name_ar : '' " />

<x-forms label="{{ __('models.name_en') }}" col="4" name="name_en" :value="$country ? $country->name_en : '' " />

<x-forms label="{{ __('models.phone_key') }}" col="4" type="number" name="phone_key" :value="$country ? $country->phone_key : '' " />

<x-forms label="{{ __('models.delivery') }}" name="delivery" :value="$country ? $country->delivery : '' " />

<x-forms label="{{ __('models.time') }}" type="number" name="time" :value="$country ? $country->time : '' " />

<x-image label="{{ __('models.img') }}"  name="img"  :value="$country ? $country->img : '' " />


<x-button label="{{ __('models.add_wallets') }}" name="wallet" color="danger">

    @if (isset($country->wallets))
    @foreach ( $country->wallets as $wallet)

      <div class="delete-row col-lg-12 row">



        <x-multi-input col="5" main="main-value-wallet" label="{{ __('models.name_ar') }}" name="wallet_ar[]" :value="$wallet->name_ar"/>
        <x-multi-input col="5" main="main-value-wallet" label="{{ __('models.name_en') }}" name="wallet_en[]" :value="$wallet->name_en"/>


              <div class="col-md-2 col-12 mb-3 mt-4">
                  <div>
                      <button class="btn btn-danger delelte-item-size"><i class="mdi mdi-trash-can-outline"></i><button>
                  </div>
              </div>
      </div>

    @endforeach

  @endif



</x-button>
