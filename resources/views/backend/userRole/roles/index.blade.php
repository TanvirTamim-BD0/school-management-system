@extends('backend.master')
@section('content')
@section('title') Role @endsection
@section('role') active @endsection
@section('role.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Role List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Role</a>
            </li>
            <li class="breadcrumb-item active">Role List
            </li>
          </ol>
        </div>


        <div class="col s12">
          <div class="card">

            <div class="card-content custom-card-content custom-card-content-for-datatable">
              <h2 class="card-title">Role-Permission Record List</h2>
            </div>

            <div class="card-content-datatable table-responsive">
              <table id="classTable" class="display custom-table custom-data-table custom-table-border">

                <thead>
                  <tr>
                    <th class="custom-border-right">SL</th>
                    <th class="custom-border-right">Name</th>
                    <th class="custom-border-right">Permissions Group</th>
                    <th class="custom-border-right">Action</th>

                  </tr>

                </thead>

                <tbody>

                  @foreach($roleData as $role)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$role->name}}</td>
                    <td style="max-width: 70%;" class="role-permission-group-title">

                      @php
                      $previousGroupName = '';
                      @endphp

                      @foreach ($role->permissions as $perm)
                      @if(isset($perm) && $perm != null )

                      @php
                      $currentGroupName = $perm->group_name;
                      @endphp

                      @if($previousGroupName != $currentGroupName)
                      <span class="badge gradient-45deg-purple-deep-orange gradient-shadow mb-1">
                        {{Str::title($perm->group_name )}}
                      </span>
                      @endif

                      @php
                      $previousGroupName = $perm->group_name;
                      @endphp

                      @endif
                      @endforeach

                    </td>

                    <td class="text-center">
                      <!-- Dropdown Trigger -->
                      <a class='dropdown-trigger btn custom-dropdown-btn custom-dropdown-bar' href='#'
                        data-target='dropdown{{$role->id}}'>
                        <i class="material-icons float-right">more_vert</i>
                      </a>
                      <!-- Dropdown Structure -->
                      <ul id='dropdown{{$role->id}}' class='dropdown-content custom-dropdown-for-action'>
                        <li>
                          @if(Auth::user()->can('role-edit'))
                          <a href="#modal1{{$role->id}}" class="modal-trigger"><i
                              class="material-icons">edit2</i>Edit</a>
                          @endif
                        </li>

                      </ul>

                    </td>


                    <!-- Modal Structure -->
                    <div id="modal1{{$role->id}}" class="modal modal-fixed-footer custom-lg-modal custom-lg-modal-css">

                      <form class="col s12" method="post" action="{{route('roles.update',$role->id)}}">
                        @csrf
                        @method('put')

                        <div class="modal-dialog" role="document">

                          <div class="modal-content">
                            <h4 class="modal-title" id="exampleModalLabel">Role Edit</h4>
                            <hr>

                            <div class="row">
                              <div class="container" id="modalData{{$role->id}}">
                                <div class="row">
                                  <div class="input-field col s12">
                                    <label>
                                      <h6 class="custom-permission-group-color custom-permission-title"
                                        for="checkPermissionAll">All
                                        Permissions
                                      </h6>
                                    </label>
                                  </div>
                                </div>

                                <hr style="margin-bottom: 25px;margin-top:20px;margin-left: 5px">

                                @php $i = 0; @endphp
                                @foreach ($permissionGroups as $key=>$group)
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
                                        <input type="checkbox" id="{{ $i }}Management{{$role->id}}"
                                          value="{{ $group->name }}"
                                          onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox{{$role->id}}', this)"
                                          {{ App\Models\User::roleHasPermissions($role, $permissions)
                                          ? 'checked' : '' }} class="filled-in" />

                                        <span for="{{ $i }}Management{{$role->id}}"
                                          class="permission-group-name">{{ Str::title($group->name) }} :</span>
                                      </label>
                                    </p>
                                  </div>


                                  <div class="input-field col s12 m8 role-{{ $i }}-management-checkbox{{$role->id}}">

                                    @foreach ($permissions as $permission)
                                    @if(isset($permission) && $permission != null)
                                    <div class="custom-inline">
                                      <label>
                                        <input class="filled-in common-input" type="checkbox" name="permissions[]"
                                          onclick="checkSinglePermission('role-{{ $i }}-management-checkbox{{$role->id}}', '{{ $i }}Management{{$role->id}}', {{ count($permissions) }})"
                                          {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                          id="checkPermission{{ $permission->id }}{{$role->id}}" value="{{ $permission->name }}">

                                        <span
                                          for="checkPermission{{ $permission->id }}{{$role->id}}">{{ Str::title($permission->short_name) }}</span>
                                      </label>
                                    </div>
                                    @endif
                                    @endforeach

                                  </div>

                                </div>
                                @endif
                                @endforeach
                              </div>

                            </div>
                          </div>

                          <div class="modal-footer">
                            <button class="mb-6 modal-action modal-close waves-effect waves-red btn-flat" type="button"
                              class="close" data-dismiss="modal">
                              Close
                            </button>

                            <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                              Update
                            </button>
                          </div>

                        </div>

                    </div>

                    </form>
            </div>


            </tr>
            @endforeach

            </tbody>

            </table>
          </div>
        </div>
      </div>

    </div>

  </div>

  @endsection

  @section('scripts')
  <script>
    $(document).ready(function() {
      $('#classTables').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
  </script>


  <script>
    function checkPermissionByGroup(className, checkThis){
      const groupIdName = $("#"+checkThis.id);
      const classCheckBox = $('.'+className+' input');

      if(groupIdName.is(':checked')){
            classCheckBox.prop('checked', true);
        }else{
            classCheckBox.prop('checked', false);
        }
    }

    function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
      const classCheckbox = $('.'+groupClassName+ ' input');
      const groupIDCheckBox = $("#"+groupID);

      // if there is any occurance where something is not selected then make selected = false
      if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
          groupIDCheckBox.prop('checked', true);
      }else{
          groupIDCheckBox.prop('checked', false);
      }
    }

    function checkPermissionAll(allInput, checkThis) {
      const allId = $("#"+checkThis.id);
      const allInputCheck = $('.'+allInput+' input');

      if(allId.is(':checked')){
            allInputCheck.prop('checked', true);
        }else{
            allInputCheck.prop('checked', false);
        }
    }


  </script>
  @endsection