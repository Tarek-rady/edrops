
<x-forms label="{{ __('models.name') }}" name="name" :value="$user ? $user->name : '' "/>
<x-forms label="{{ __('models.email') }}" type="email" name="email" :value="$user ? $user->email : '' "/>
<x-forms label="{{ __('models.phone') }}" type="number" name="phone" :value="$user ? $user->phone : '' "/>
<x-forms label="{{ __('models.password') }}" type="password" name="password" />
<x-select label="{{ __('models.countries') }}" name="country_id" :options="$countries->pluck('name' , 'id')" :value="$user ? $user->country : '' "/>
<x-select label="{{ __('models.cities') }}" name="city_id" :options="[]" :value="$user ? $user->country : '' "/>
<x-forms label="{{ __('models.company') }}" name="company" :value="$user ? $user->company : '' "/>
<div class="col-md-6"></div>
<x-image label="{{ __('models.img') }}" name="img" :value="$user ? $user->img : '' " />
