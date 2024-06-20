<x-forms label="{{ __('models.name_ar') }}"  name="name_ar" :value="$category ? $category->name_ar : '' "/>
<x-forms label="{{ __('models.name_en') }}"  name="name_en" :value="$category ? $category->name_en : '' "/>
<x-image label="{{ __('models.img') }}" name="img" :value="$category ? $category->img : '' " />
