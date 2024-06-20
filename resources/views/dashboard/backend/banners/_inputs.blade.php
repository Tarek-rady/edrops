
<x-forms label="{{ __('models.title_ar') }}" name="title_ar" :value="$banner ? $banner->title_ar : ''"/>
<x-forms label="{{ __('models.title_en') }}" name="title_en" :value="$banner ? $banner->title_en : ''"/>
<x-forms label="{{ __('models.link') }}" name="link" :value="$banner ? $banner->link : ''"/>
<div class="col-md-6"></div>
<x-textarea label="{{ __('models.desc_ar') }}" name="desc_ar" :value="$banner ? $banner->desc_ar : '' "/>
<x-textarea label="{{ __('models.desc_en') }}" name="desc_en" :value="$banner ? $banner->desc_en : '' "/>
<x-image label="{{ __('models.images') }}" name="img" :value="$banner ? $banner->img : '' "/>
