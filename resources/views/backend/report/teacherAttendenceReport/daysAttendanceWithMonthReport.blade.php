<h4>Month Wise Attendance History</h4>

<div class="float-right mb-4 custom-go-back-profile-btn ">
    <form class="col s12" method="post" action="{{route('report-of-attendence-teacher-day-invoice')}}"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="teacherId" value="{{ $teacher->id }} ">
        <input type="hidden" name="monthName" value="{{ $currentMonth }} ">

        <button class="btn btn-primary" style="margin-right: -16px;margin-top:-165px;">Print</button>
    </form>
</div>

<div class="divider"></div>


<table class="table table-striped text-center table-bordered dt-responsive nowrap">
    <thead>
        <tr class=" text-center">
            <th class=" custom-border-right text-center">Months</th>
            <th class=" custom-border-right text-center">Date</th>
            <th class=" custom-border-right text-center">Presents</th>
            <th class=" custom-border-right text-center">Absence</th>
            <th class=" custom-border-right text-center">Late</th>
            <th class=" custom-border-right text-center">Leave</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dates as $date)
        @php
        $data = App\Models\TeacherAttendance::teacherAttendance($teacher->id, $date);
        @endphp

        <tr class=" text-center">
            <th class=" custom-border-right text-center">
                {{ $currentMonth }}
            </th>

            <th class=" custom-border-right text-center">
                {{Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y')}}
            </th>

            <td class=" custom-border-right text-center">
                @if ($data != null && $data != null)
                @if ($data->present == 1 && $data->date == $date)
                <span class=" common-status-padding badge badge-light-success p-1 "
                    style="color: #00FF00">Present</span>
                @else
                <span class="">Present</span>
                @endif
                @else
                <span class="">Present</span>
                @endif
            </td>
            <td class=" custom-border-right text-center">
                @if ($data != null && $data != null)
                @if ($data->absence == 1 && $data->date == $date)
                <span class="common-status-padding badge badge-light-danger p-1 " style="color: red">Absence</span>
                @else
                <span class="">Absence</span>
                @endif
                @else
                <span class="">Absence</span>
                @endif
            </td>
            <td class=" custom-border-right text-center">
                @if ($data != null && $data != null)
                @if ($data->late == 1 && $data->date == $date)
                <span class="common-status-padding badge badge-light-primary p-1 " style="color: #F4A460;">Late</span>
                @else
                <span class="">Late</span>
                @endif
                @else
                <span class="">Late</span>
                @endif
            </td>
            <td class=" custom-border-right text-center">
                @if ($data != null && $data != null)
                @if ($data->leave == 1 && $data->date == $date)
                <span class="common-status-padding badge badge-light-warning p-1 " style="color: #1E90FF;">Leave</span>
                @else
                <span class="">Leave</span>
                @endif
                @else
                <span class="">Leave</span>
                @endif
            </td>
        </tr>
        @endforeach

    </tbody>
</table>