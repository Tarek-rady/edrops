@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.edit_role') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.edit_role') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">{{ __('models.roles') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.edit_role') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.roles.update' , $role->id) }}" enctype="multipart/form-data" novalidate>
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="id" value="{{ $role->id }}">



                        {{--  name  --}}
                        <div class="col-md-6">
                            <x-forms lable="{{ __('models.name') }}" name="name" :value="$role->name"/>
                        </div>


                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">

                                    </th>
                                    <th class="sort">{{ __('models.model') }}</th>
                                    <th class="sort">{{ __('models.permissions') }}</th></th>

                                </tr>
                            </thead>
                            <tbody class="list form-check-all">

                                @foreach (config('laratrust_seeder.roles_structure.owner') as $model=>$permissions)

                                    <tr>
                                        <th scope="row">
                                        </th>

                                        <td>{{__('models.'. $model)}}</td>

                                        <td>
                                            <div class="permissions">


                                            @foreach (explode(',' ,$permissions) as $permission)


                                            <input type="checkbox" value="{{$model}}-{{config('laratrust_seeder.permissions_map')[$permission]}}" name="permissions[]"  class="{{$model}}" {{ $role->hasPermission($model . '-' . config('laratrust_seeder.permissions_map')[$permission]) ? 'checked':''}}>
                                            <label>{{__('models.' . $permission)}}</label>


                                            @endforeach

                                            </div>
                                        </td>







                                    </tr>

                                @endforeach


                            </tbody>
                        </table>

                    </div>


                    <section id="basic-datatable" style="width: 100%">

                        <!-- Company Table Card -->
                        <div class="col-lg-12 col-12">
                            <div class="card card-company-table">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('models.stocks') }}</th>
                                                    <th>{{ __('models.permissions') }}</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ( $stocks as $stock)

                                                    <tr>


                                                        <td>{{ $stock->name }}</td>

                                                        <td>
                                                            <div class="permissions">

                                                                <input type="checkbox" value={{ $stock->id }} name="stocks[]" value="{{ $stock->id }}" id="{{ $stock->id }}" {{ $role->stocks->contains('id' , $stock->id) == 1 ? 'checked' : '' }}>
                                                                <label for="{{ $stock->id }}">{{__('models.r')}}</label>


                                                            </div>
                                                        </td>



                                                    </tr>



                                                @endforeach

                                            </tbody>
                                        </table>




                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Company Table Card -->

                    </section>














                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{ __('models.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
</div>



@endsection


@section('js')
<script src="{{ asset('dashboard/assets/js/preview-image.js') }}"></script>

@endsection
