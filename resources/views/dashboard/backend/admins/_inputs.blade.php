
    <x-forms label="{{ __('models.name') }}" name="name" :value="$admin ? $admin->name : '' "/>

    <x-forms label="{{ __('models.email') }}" type="email" name="email" :value="$admin ? $admin->email : '' " />

    <x-forms label="{{ __('models.password') }}" type="password" name="password" />

    <x-role-select name="role_id" label="{{ __('models.roles') }}" :options="$roles->pluck('name', 'id')" :value="$admin?$admin:''" />

   <x-image label="{{ __('models.img') }}" name="img" type="file" id="formFile" :value="$admin?$admin->img:''" />



