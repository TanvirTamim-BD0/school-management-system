@extends('backend.master')
@section('content')
@section('title') Guardian Create @endsection
@section('guardian') active @endsection
@section('guardian.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Guardian Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Guardian</a>
            </li>
            <li class="breadcrumb-item active">Guardian Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content">

        <div class="float-right">

          @if(Auth::user()->can('guardian-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('guardian.index')}}">
            <i class="material-icons dp48">list</i> Guardian List
          </a>
          @endif

        </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('guardian.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="col s12 m4">
                <div class="input-field">
                  <select class="select2 browser-default" id="class_id" name="class_id" required>
                    <option value="" selected disabled>Select Class <span class="custom-text-danger">*</span></option>
                    @foreach($classData as $singleClassData)
                    @if(isset($singleClassData) && $singleClassData != null)
                    <option value="{{ $singleClassData->id }}">{{ $singleClassData->class_name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col s12 m4">
                <div class="input-field">
                  <select class="select2 browser-default" name="section_id" id="section_id"
                     required>
                    <option value="" selected disabled>Select Section <span class="custom-text-danger">*</span></option>

                  </select>
                </div>
              </div>


              <div class="col s12 m4">
                <div class="input-field">
                  <select class="select2 browser-default" name="student_id" id="student_id"
                     required>
                    <option value="" selected disabled>Select Student <span class="custom-text-danger">*</span></option>

                  </select>
                </div>
              </div>


              <div class="input-field col s12 m6">
                <input id="guardian_name" type="text" class="validate" name="guardian_name" required
                  value="{{ old('guardian_name') }}">
                <label for="guardian_name"> Name <span class="custom-text-danger">*</span> </label>

                @error('guardian_name')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <input id="phone" type="number" class="validate" name="phone" value="{{ old('phone') }}" required>
                <label for="phone"> Phone <span class="custom-text-danger">*</span> </label>

                @error('phone')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                <label for="email"> Email <span class="custom-text-danger">*</span> </label>

                @error('email')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="address" type="text" class="validate" name="address" value="{{ old('address') }}" required>
                <label for="address"> Address <span class="custom-text-danger">*</span> </label>

                @error('address')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="profession" type="text" class="validate" name="profession"
                  value="{{ old('profession') }}">
                <label for="profession">Profession </label>

                @error('profession')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <input id="loginPassword" type="text" class="validate" name="loginPassword" required>
                <label for="loginPassword">Login Password <span class="custom-text-danger">*</span> </label>

                @error('loginPassword')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m12">
                <div class="col s12 m4 l2 mb-1">
                  <p>Photo </p>
                </div>
              
                <input type="file" id="photo" name="photo" class="dropify" data-default-file="" />
              
                @error('photo')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="col s12 mb-3 mt-3">
                <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                  Submit
                </button>
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>

</div>

<script>
  // Small
    $('.select2-size-sm').select2({
        dropdownAutoWidth: true,
        width: '100%',
        containerCssClass: 'select-sm'
    });
</script>

@endsection

@section('scripts')
@include('backend.guardian.partial.script')

@endsection