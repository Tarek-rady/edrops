<x-forms label="{{ __('models.name_ar') }}"  name="name_ar" :value="$brand ? $brand->name_ar : '' "/>
<x-forms label="{{ __('models.name_en') }}"  name="name_en" :value="$brand ? $brand->name_en : '' "/>
<x-image label="{{ __('models.img') }}" name="img" :value="$brand ? $brand->img : '' " />
