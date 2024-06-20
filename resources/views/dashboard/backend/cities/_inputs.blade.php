
<x-forms name="name_ar" label="{{ __('models.name_ar') }}" :value="$city ? $city->name_ar : '' "/>
<x-forms name="name_en" label="{{ __('models.name_en') }}" :value="$city ? $city->name_en : '' "/>
<x-select name="country_id" label="{{ __('models.countries') }}" :options="$countries->pluck('name', 'id')" :value="$city?$city->country:''" />

