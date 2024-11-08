@extends('backend.master')
@section('content')
@section('title') Make Payment @endsection
@section('make-payment') active @endsection
@section('get-user-details-with-role-wise') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Make Payment</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Make Payment
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="print-conatiner">

        <div class="col s12 m12">
            <div class="card">

                <div class="card-content custom-table-filtering-header">
                    <div class="row">

                        <form method="post" action="{{route('get-user-details-with-role-wise')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                

                                <div class="input-field col s12 m12">
                                    <select class="select2 browser-default" name="role_id" id="role_id" required>
                                        <option value="" disabled selected>Select Role <span
                                                class="custom-text-danger">*</span> </option>


                                        @if(isset($selectedRoleData) && $selectedRoleData != null)
                                            @foreach($roleData as $singleroleData)
                                            @if(isset($singleroleData) && $singleroleData != null)
                                            <option value="{{ $singleroleData->id }}" {{ $singleroleData->id == $selectedRoleData->id ? 'selected' : '' }}>
                                                {{ Str::title($singleroleData->name) }}</option>
                                            @endif
                                            @endforeach
                                        @else
                                            @foreach($roleData as $singleroleData)
                                            @if(isset($singleroleData) && $singleroleData != null)
                                            <option value="{{ $singleroleData->id }}">{{ Str::title($singleroleData->name) }}</option>
                                            @endif
                                            @endforeach
                                        @endif

                                    </select>

                                    @error('role_id')
                                    <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col m12  s12 custom-text-center">
                                    <button
                                        class="mb-1 btn waves-effect waves-light purple lightrn-1 custom-filter-button"
                                        type="submit">
                                        <i class="material-icons">search</i>
                                        <span>Filter</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <div class="card">

                <div class="card-content custom-card-content custom-card-content-for-datatable">
                    <h2 class="card-title">Teacher Record List</h2>
                </div>

                <div class="card-content-datatable table-responsive custom-filter-content-datatable">
                    <table id="studentTable"
                        class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">
                        <thead>
                            <tr>
                                <th class="custom-border-right custom-sl-no">SL</th>
                                <th class="custom-border-right custom-attendance-image-th">Photo</th>
                                <th class="custom-border-right custom-attendance-details-th">User Details</th>
                                <th class="custom-border-right custom-attendance-details-th">Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($userData as $key => $item)
                            @if(isset($item) && $item != null)
                            <tr>
                                @php
                                $userDetailData = App\Models\User::getUserDeatilsData($item->id);
                              
                                @endphp
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if(isset($userDetailData) && $userDetailData != null)
                                    @if(isset($userDetailData->teacher_photo) && $userDetailData->teacher_photo != null)
                                        <img src="{{ asset('/uploads/teacher_photo/'.$userDetailData->teacher_photo) }}" width="75" height="65">
                                    @else
                                        @if(isset($userDetailData->gender) && $userDetailData->gender == 'male')
                                            <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
                                        @else
                                            <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="75" height="65">
                                        @endif
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if(isset($userDetailData) && $userDetailData != null)
                                        Name: {{$userDetailData->teacher_name}} <br>
                                        Email: {{$userDetailData->teacher_email}} <br>
                                        Phone: {{$userDetailData->teacher_phone}}
                                    @endif
                                </td>

                                <td>
                                    @if(isset($userDetailData) && $userDetailData != null)
                                        Salary: {{$userDetailData->salary}}
                                    @endif
                                </td>

                                <td class=" text-center">
                                    @if(Auth::user()->can('make-payment'))
                                        <a href="{{route('make-payment-for-teacher', $userDetailData->id)}}" class="mb-6 btn waves-effect waves-light gradient-45deg-green-teal 
                                        gradient-shadow custom-display-flex custom-make-payment-btn">
                                        <i class="material-icons">monetization_on</i>
                                        <span>Make Payment</span>
                                    </a>
                                    @endif
                                </td>

                            </tr>
                            @endif
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
      $('#studentTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection