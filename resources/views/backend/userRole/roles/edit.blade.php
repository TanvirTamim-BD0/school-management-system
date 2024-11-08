@extends('backend.master')
@section('content')
@section('title') Role Edit @endsection
@section('roles') active @endsection
@section('roles.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Role Edit</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Role</a>
            </li>
            <li class="breadcrumb-item active">Role Edit
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Role Upadte</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('role-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('roles.index')}}">
            <i class="material-icons dp48">dehaze</i> Role List
          </a>
          @endif
        </div>
      </div>

      <div class="card-content">

        <div class="row">
          <form class="col s12" method="post" action="{{route('roles.update',$role->id)}}">
            @csrf
            @method('put')

            <div class="row">
              <div class="input-field col s12">
                {{-- <label>
                  <input class="filled-in" name="group3" type="checkbox" id="checkPermissionAll" value="1"
                    {{ App\Models\User::roleHasPermissions($role, $allPermissions) ? 'checked' : '' }}
                    onclick="checkPermissionByGroup('all-input-checkbox', this)" />

                  <span class="custom-permission-group-color" for="checkPermissionAll">All Permissions</span>
                </label> --}}
               
                <label>
                  <h5 class="custom-permission-group-color" for="checkPermissionAll">All Permissions</h5>
                </label>
              </div>
            </div>

            <hr class="mt-5" style="margin-bottom: 45px;">

            @php $i = 0; @endphp
            @foreach ($permissionGroups as $group)
            @if(isset($group) && $group != null)
            <div class="row all-input-checkbox">

              @php
              $permissions = App\Models\User::getpermissionsByGroupName($group->name);
              $j = 1;
              $i += 1;
              @endphp

              <div class="input-field col s12 m4">
                <p>
                  <label class="custom-permission-group-color">
                    <input type="checkbox" id="{{ $i }}Management" value="{{ $group->name }}"
                      onclick="checkPermissionByGroup('role-{{$i}}-management-checkbox', this)"
                      {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }} 
                      class="filled-in"/>

                    <span for="{{ $i }}Management">{{ Str::title($group->name) }}</span>
                  </label>
                </p>
              </div>


              <div class="input-field col s12 m8 role-{{ $i }}-management-checkbox">

                @foreach ($permissions as $permission)
                @if(isset($permission) && $permission != null)
                <p>
                  <label>
                    <input class="filled-in common-input" type="checkbox" name="permissions[]"
                      onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})"
                      {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                      id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">

                    <span for="checkPermission{{ $permission->id }}">{{ $permission->short_name }}</span>
                  </label>
                </p>
                @endif
                @endforeach

              </div>

            </div>
            @endif
            @endforeach

            <div class="col s12 mb-3 mt-5">
              <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                Update
              </button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>

</div>

@endsection

@section('scripts')
@include('backend.userRole.roles.partial.script')
@endsection