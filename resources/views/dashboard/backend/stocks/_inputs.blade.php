<x-forms col="4"  name="name_ar"    label="{{ __('models.name_ar') }}"   :value="$stock ? $stock->name_ar : '' " />
<x-forms col="4"  name="name_en"    label="{{ __('models.name_en') }}"   :value="$stock ? $stock->name_en : '' " />
<x-forms col="4"  name="link"       label="{{ __('models.link') }}"      :value="$stock ? $stock->link : '' " />
<x-select name="country_id" label="{{ __('models.countries') }}"         :options="$countries->pluck('name', 'id')" :value="$stock?$stock->country:''" />
<x-select name="city_id" label="{{ __('models.cities') }}"               :options="[]" :value="$stock?$stock->city:''" />
