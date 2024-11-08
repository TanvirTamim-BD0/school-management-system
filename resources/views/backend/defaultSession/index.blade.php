@extends('backend.master')
@section('content')
@section('title') Default Session Update @endsection
@section('default-session') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Default Session</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Default Session
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card">

            <div class="card-content custom-card-content custom-card-content-for-datatable">
                <h2 class="card-title">Update Default Session</h2>
                <div class="float-right justify-content-end">
                   
                </div>
            </div>

            <div class="card-content custom-table-filtering-header">

                <form method="post" action="{{route('update-default-session')}}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col s12 m12">
                            <div class="input-field">
                                <label for="session_year" class="custom-label-class">Session Year <span class="custom-text-danger">*</span></label>
                                
                                @if(isset($defaultSessionData) && $defaultSessionData != null)
                                    <select class="select2 browser-default" id="session_year" name="session_year" required>
                                        <option value="" selected disabled>Select Default Year</option>
                                        
                                        @foreach($sessionData as $session)
                                        @if(isset($session) && $session != null)
                                        <option value="{{ $session->session_name }}" {{ $defaultSessionData->session_year == $session->session_name ? 'selected' : '' }}>{{ $session->session_name }}</option>
                                        @endif
                                        @endforeach
                                    
                                    </select>
                                @else
                                    <select class="select2 browser-default" id="session_year" name="session_year" required>
                                        <option value="" selected disabled>Select Default Year</option>
                                    
                                        @foreach($sessionData as $session)
                                        @if(isset($session) && $session != null)
                                        <option value="{{ $session->session_name }}">{{ $session->session_name }}</option>
                                        @endif
                                        @endforeach
                                    
                                    </select>
                                @endif

                                @error('session_year')
                                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col m12  s12 custom-text-center">
                            <button class="mb-1 btn waves-effect waves-light purple lightrn-1 custom-filter-button"
                                type="submit">
                                <span>Update</span>
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection
@section('scripts')
@include('backend.extendClassOfStudent.partial.script')
@endsection