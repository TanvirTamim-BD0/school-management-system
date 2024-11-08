<h2 class="card-title custom-payment-title mt-1">Month Wise Attendance History</h2>
<a href="{{ route('student-profile',$student->id) }}"
	class="waves-effect waves dark btn gradient-45deg-purple-deep-orange custom-go-back-profile-btn">Back To Profile</a>
<div class="divider"></div>

<table class="table table-striped text-center table-bordered dt-responsive nowrap">
	<thead>
		<tr class=" text-center">
			<th class=" text-left">Months</th>
			<th class=" text-left">Date</th>
			<th>Presents</th>
			<th>Absence</th>
			<th>Late</th>
			<th>Leave</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($dates as $date)
		@php
		$data = App\Models\StudentAttendance::studentAttendance($student->class_id, $student->section_id, $student->id,
		$date);
		@endphp

		<tr class=" text-center">
			<th class=" text-left">
				{{ $currentMonth }}
			</th>

			<th class=" text-left">
				{{Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y')}}
			</th>

			<td>
				@if ($data != null && $data != null)
				@if ($data->present == 1 && $data->date == $date)
				<span class="common-status-padding badge badge-light-success p-1 " style="color: #00FF00">Present</span>
				@else
				<span class="">Present</span>
				@endif
				@else
				<span class="">Present</span>
				@endif
			</td>
			<td>
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
			<td>
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
			<td>
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