@extends('backend.master')
@section('content')
@section('title') Teacher Book Issue @endsection
@section('book-issue-teacher') Book Issue @endsection
@section('book-issue-teacher.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Teacher Book Issue List</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Teacher Book Issue</a>
                        </li>
                        <li class="breadcrumb-item active">Teacher Book Issue List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card">

            <div class="card-content custom-card-content custom-card-content-for-datatable">
                <h2 class="card-title">Teacher Book Issue Record List</h2>
                <div class="float-right justify-content-end">

                </div>
            </div>

            <div class="card-content-datatable table-responsive">
                <table id="sectionTable"
                    class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

                    <thead>
                        <tr>
                            <th class="custom-border-right">SL</th>
                            <th class="custom-border-right">Teacher</th>
                            <th class="custom-border-right">Book</th>
                            <th class="custom-border-right">Issue Date</th>
                            <th class="custom-border-right">Return Date</th>
                            <th class="custom-border-right">Note</th>
                            <th class="custom-border-right">Status</th>
                            <th class="custom-border-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($expireIssuedData as $teacherBookIssue)
                        @if(isset($teacherBookIssue) && $teacherBookIssue != null)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$teacherBookIssue->teacherData->teacher_name}}</td>
                            <td>{{$teacherBookIssue->LibraryBookData->subject_name}}</td>
                            <td>
                                {{Carbon\Carbon::createFromFormat('Y-m-d', $teacherBookIssue->issue_date)->format('d-m-Y')}}
                            </td>
                            <td>
                                {{Carbon\Carbon::createFromFormat('Y-m-d', $teacherBookIssue->return_date)->format('d-m-Y')}}
                            </td>
                            <td>{{$teacherBookIssue->note}}</td>
                            <td>
                                @if($teacherBookIssue->status == 1)
                                <b><span style="color: green;">Returned</span></b>
                                @else
                                <b><span style="color: red;">Borrowed</span></b>
                                @endif
                            </td>

                            <td class="text-center">
                                <!-- Dropdown Trigger -->
                                <a class='dropdown-trigger btn custom-dropdown-btn' href='#'
                                    data-target='dropdown1{{$teacherBookIssue->id}}'>
                                    <i class="material-icons float-right">more_vert</i>
                                </a>
                                <!-- Dropdown Structure -->
                                <ul id='dropdown1{{$teacherBookIssue->id}}'
                                    class='dropdown-content custom-dropdown-for-action'>
                                    <li>
                                        <a href="{{ route('teacher-book-return',$teacherBookIssue->id) }}"><i
                                                class="material-icons">keyboard_return</i>Return</a>
                                    </li>


                                </ul>

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

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
      $('#sectionTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection