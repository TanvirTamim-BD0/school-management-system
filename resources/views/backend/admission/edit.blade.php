@extends('backend.master')
@section('content')
@section('title') Admission Edit @endsection
@section('admission') active @endsection
@section('admission.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Admission Edit</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Admission</a>
            </li>
            <li class="breadcrumb-item active">Admission Edit
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
          @if(Auth::user()->can('admission-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('admission.index')}}">
            <i class="material-icons dp48">list</i> Admission List
          </a>
          @endif
        </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('admission.update',$admission->id)}}">
            @csrf
            @method('put')
            <div class="row">

              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="class_id" required>
                  <option value="" disabled selected>Select Class <span class="custom-text-danger">*</span></option>
                  @foreach($classes as $class)
                  <option value="{{$class->id}}" class="left circle"
                    {{$class->id == $admission->class_id ? "selected":""  }}>{{$class->class_name}}</option>
                  @endforeach

                </select>

                @error('class_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror

              </div>

              <div class="input-field col s12 m6">
                <input id="admission_name" type="text" class="validate" name="admission_name" required
                  value="{{$admission->admission_name}}">
                <label for="admission_name">Admission Name <span class="custom-text-danger">*</span></label>

                @error('admission_name')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="fees" type="text" class="validate" name="fees" required value="{{$admission->fees}}">
                <label for="fees">Fees <span class="custom-text-danger">*</span></label>

                @error('fees')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="available_days" required>
                  <option value="" disabled selected>Select Available Days <span class="custom-text-danger">*</span></option>
                  <option value="5" {{$admission->available_days == '5' ? "selected":""  }}>5 Days</option>
                  <option value="10" {{$admission->available_days == '10' ? "selected":""  }}>10 Days</option>
                  <option value="15" {{$admission->available_days == '15' ? "selected":""  }}>15 Days</option>
                  <option value="20" {{$admission->available_days == '20' ? "selected":""  }}>20 Days</option>
                  <option value="25" {{$admission->available_days == '25' ? "selected":""  }}>25 Days</option>
                  <option value="30" {{$admission->available_days == '30' ? "selected":""  }}>30 Days</option>

                </select>

                @error('available_days')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="col s12 mb-3">
                <button class="mb-6 btn waves-effect waves-light purple lightrn-1 gradient-45deg-light-blue-cyan" type="submit">
                  Update
                </button>
              </div>

            </div>

          </form>
        </div>

      </div>
    </div>
  </div>

</div>

@endsection

@section('scripts')
@include('backend.admission.partial.script')

@endsection