
<x-forms label="{{ __('models.title_ar') }}" name="title_ar" :value="$new ? $new->title_ar : ''"/>
<x-forms label="{{ __('models.title_en') }}" name="title_en" :value="$new ? $new->title_en : ''"/>
<x-textarea label="{{ __('models.desc_ar') }}" name="desc_ar" :value="$new ? $new->desc_ar : '' "/>
<x-textarea label="{{ __('models.desc_en') }}" name="desc_en" :value="$new ? $new->desc_en : '' "/>
<x-image label="{{ __('models.images') }}" name="img" :value="$new ? $new->img : '' "/>
