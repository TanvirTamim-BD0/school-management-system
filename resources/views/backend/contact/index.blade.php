@extends('backend.master')
@section('content')
@section('title') Contact @endsection
@section('contacts') active @endsection
@section('contacts') active @endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/dropify/css/dropify.min.css">
<style>
  .modal {
    display: none;
  }

  .datepicker-modal {
    display: none;
  }

</style>
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Contact Update</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Contact</a>
            </li>
            <li class="breadcrumb-item active">Contact Update
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content">

        <div class="row">

          <form class="col s12" method="post" action="{{route('contact.update',$contact->id)}}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="input-field col s12 m6">
                <input id="name" type="text" class="validate" name="name" value="{{$contact->name}}" required>
                <label for="name">Name <span class="custom-text-danger">*</span> </label>

                @error('name')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <input id="phone" type="text" class="validate" name="phone" value="{{$contact->phone}}" required>
                <label for="phone">Phone <span class="custom-text-danger">*</span></label>

                @error('phone')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <input id="email" type="email" class="validate" name="email" value="{{$contact->email}}">
                <label for="email">Email </label>

                @error('email')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="address" type="text" class="validate" name="address" value="{{$contact->address}}">
                <label for="address">Address </label>

                @error('address')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="facebook" type="text" class="validate" name="facebook" value="{{$contact->facebook}}">
                <label for="facebook">Facebook </label>

                @error('facebook')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="twitter" type="text" class="validate" name="twitter" value="{{$contact->twitter}}">
                <label for="twitter">Twitter </label>

                @error('twitter')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
              
              <div class="input-field col s12 m3">
                <label for="photo">Photo </label><br><br>
                @if(isset($contact->student_photo) && $contact->student_photo != null)
                <img src="{{asset('uploads/logo_image/'.$contact->logo_image)}}" width="150" height="30">
                @else
                <img src="{{asset('uploads/logo_image/default/logo.png')}}" width="150" height="30">
                @endif
              </div>
             
              <div class="input-field col s12 m9">
                <input type="file" id="logo_image" name="logo_image" value="{{$contact->logo_image}}" class="dropify"
                  data-default-file="" />
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
<script src="{{ asset('backend') }}/app-assets/vendors/dropify/js/dropify.min.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/form-file-uploads.js"></script>

@include('backend.guardian.partial.script')

@endsection