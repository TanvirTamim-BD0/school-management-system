@extends('backend.master')
@section('content')
@section('title') Librarian Attendance Update @endsection
@section('attendace-of-librarian') active @endsection
@section('attendace-of-librarian.index') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Librarian Attendance List</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Librarian Attendance Update
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card">

            <div
                class="card-content custom-card-content custom-table-filtering-header custom-attendance-academic-header">
                <div class="custom-class-section">
                    <div class="float-left justify-content-end">
                        <h5>Attendance Deatils: </h5>
                        <h5>Librarian Record: </h5>
                    </div>
                </div>
                <div class="float-right justify-content-end">
                    <div class="float-right justify-content-end custom-class-date">
                        <h5>Date: <span class="custom-text-gray">{{ $selectedDate }}</span></h5>
                        <h5>Librarians: <span class="custom-text-gray">{{ $librarianData->count() }}</span></h5>
                    </div>
                </div>
            </div>

        </div>

        <div class="card">

            <div class="card-content custom-card-content custom-card-content-for-datatable pb10">
                <h2 class="card-title">Librarian Record List</h2>
                <div class="float-right justify-content-end">
                </div>
            </div>

            <div
                class="card-content-datatable table-responsive custom-filter-content-datatable custom-attendance-table">
                <form method="POST" action="{{ route('attendace-of-librarian.update', $data->id) }}" class="d-inline">
                    @csrf
                    @method('put')

                    <table id=""
                        class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">
                        <thead>
                            <tr>
                                <th class="custom-border-right">SL</th>
                                <th class="custom-border-right">Photo</th>
                                <th class="custom-border-right">Librarian Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($librarianData as $key => $item)
                            @if(isset($item) && $item != null)
                            <tr>
                                <input type="hidden" name="librarian_id[]" value="{{ $item->librarian_id }}">
                                <input type="hidden" name="date" value="{{ $selectedDate }}">

                                <td>{{ $loop->iteration }}</td>
                                <td class="custom-attendance-image">
                                    @if(isset($item->librarianData->librarian_photo) && $item->librarianData->librarian_photo != null)
                                    <img src="{{ asset('/uploads/librarian_photo/'.$item->librarianData->librarian_photo) }}" width="75"
                                        height="65">
                                    @else
                                    @if($item->gender == 'male')
                                    <img src="{{ asset('backend/app-assets/images/user/1.jpg') }}" width="75"
                                        height="65">
                                    @else
                                    <img src="{{ asset('backend/app-assets/images/user/12.jpg') }}" width="75"
                                        height="65">
                                    @endif
                                    @endif
                                </td>
                                <td class="custom-academic-details">
                                    Name: {{$item->librarianData->librarian_name}} <br>
                                    Gmail: {{$item->librarianData->librarian_email}} <br>
                                </td>

                                <td class="custom-attendance-action-button">
                                    <div class="btn-group">

                                        <div class="form-check form-check-inline">
                                            <label>
                                                <input class="with-gap" type="radio" id="present{{ $item->librarian_id }}"
                                                    name="attendance[{{ $item->librarian_id }}]" value="present" 
                                                    {{$item->present == 1 ? 'checked' : '' }} />

                                                <span class="present">Present</span>
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <label>
                                                <input class="with-gap" type="radio" id="absence{{ $item->librarian_id }}"
                                                    name="attendance[{{ $item->librarian_id }}]" value="absence" 
                                                    {{$item->absence == 1 ? 'checked' : '' }} />

                                                <span class="absence">Absence</span>
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <label>
                                                <input class="with-gap" type="radio" id="late{{ $item->librarian_id }}"
                                                    name="attendance[{{ $item->librarian_id }}]" value="late" 
                                                    {{$item->late == 1 ? 'checked' : '' }} />

                                                <span class="late">Late</span>
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <label>
                                                <input class="with-gap" type="radio" id="leave{{ $item->librarian_id }}"
                                                    name="attendance[{{ $item->librarian_id }}]" value="leave" 
                                                    {{$item->leave == 1 ? 'checked' : '' }} />

                                                <span class="leave">Leave</span>
                                            </label>
                                        </div>


                                    </div>
                                </td>

                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="custom-border-right">SL</th>
                                <th class="custom-border-right">Photo</th>
                                <th class="custom-border-right">Librarian Details</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="form-submit-section text-center custom-attendance-footer-button">
                        <a class="btn btn-danger back-button" href="{{ route('attendace-of-librarian.index') }}">
                            <i class="fa fa-lg fa-trash"></i>Back
                        </a>

                        <button type="submit" class="btn btn-primary attendance-submit-button">
                            <i class="fa fa-lg fa-trash"></i>Update Attendance
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection
@section('scripts')
@include('backend.assignment.partial.script')

<script>
    $(document).ready(function() {
      $('#accountentTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection