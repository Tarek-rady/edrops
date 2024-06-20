<x-forms col="4" label="{{ __('models.first_name') }}" name="first_name" :value="$saller ? $saller->first_name : '' " />
<x-forms col="4" label="{{ __('models.last_name') }}" name="last_name" :value="$saller ? $saller->last_name : '' " />
<x-forms col="4" label="{{ __('models.name') }}" name="name" :value="$saller ? $saller->name : '' " />
<x-forms col="4" type="email" label="{{ __('models.email') }}" name="email" :value="$saller ? $saller->email : '' " />
<x-forms col="4" type="password" label="{{ __('models.password') }}" name="password"  />
<x-forms col="4" type="number" label="{{ __('models.phone') }}" name="phone" :value="$saller ? $saller->phone : '' " />
<x-select name="country_id" label="{{ __('models.countries') }}" :options="$countries->pluck('name', 'id')" :value="$saller?$saller->country:''" />
<x-select name="city_id" label="{{ __('models.cities') }}"       :options="[]" :value="$saller?$saller->city:''" />
<x-forms  label="{{ __('models.region') }}" name="region" :value="$saller ? $saller->region : '' " />
<x-forms  label="{{ __('models.address') }}" name="address" :value="$saller ? $saller->address : '' " />
<x-forms  label="{{ __('models.address_2') }}" name="address_2" :value="$saller ? $saller->address_2 : '' " />
<x-forms  label="{{ __('models.company') }}" name="company" :value="$saller ? $saller->company : '' " />
<x-forms  label="{{ __('models.facebook') }}" name="facebook" :value="$saller ? $saller->facebook : '' " />
<x-forms  label="{{ __('models.instagram') }}" name="instagram" :value="$saller ? $saller->instagram : '' " />
<x-forms  label="{{ __('models.shopify') }}" name="shopify" :value="$saller ? $saller->shopify : '' " />
<div class="col-md-6"> </div>
<x-image label="{{ __('models.img') }}" name="img" type="file" id="formFile" :value="$saller?$saller->img:''" />
<x-image label="{{ __('models.logo') }}" name="logo" type="file" id="formFile-logo" :value="$saller?$saller->logo:''" />
<x-image label="{{ __('models.passport') }}" name="passport" type="file" id="formFile-passport" :value="$saller?$saller->passport:''" />
