
<x-forms name="name_ar" label="{{ __('models.name_ar') }}" :value="$currency ? $currency->name_ar : '' "/>
<x-forms name="name_en" label="{{ __('models.name_en') }}" :value="$currency ? $currency->name_en : '' "/>
<x-forms name="code" label="{{ __('models.code') }}" :value="$currency ? $currency->code : '' "/>
<x-forms name="exchange" label="{{ __('models.exchange') }}" :value="$currency ? $currency->exchange : '' "/>

