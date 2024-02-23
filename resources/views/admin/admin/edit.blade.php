@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>{{ __('Back') }}</a>
        <div class="col-6 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="modal-title" id="exampleModalLabel">{{ __("Edit") }}</h5>


                        <div class="form-group">
                            <label for="first_name">{{ __('First Name') }}</label>
                            <input type="text" id="first_name" class="form-control" name="first_name"
                                   value="{{ $data->first_name }}" placeholder="{{ __('First Name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }} </label>
                            <input type="text" id="last_name" class="form-control" name="last_name"
                                   value="{{ $data->last_name }}" placeholder="{{ __('Last Name') }} ru" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="text" id="email" class="form-control" name="email" value="{{ $data->email }}"
                                   placeholder="{{ __('Email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input type="text" id="phone" class="form-control" name="phone" value="{{ $data->phone }}"
                                   placeholder="{{ __('Phone') }}" required>
                        </div>
                        @if($data->is_admin)
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" id="password" class="form-control" name="password"
                                       placeholder="{{ __('Password') }}" required>
                            </div>
                    @endif


                </div>
                <div class="m-3">
                    <button type="submit" class="btn btn-primary d-inline-block">{{ __("Edit") }}</button>
                </div>

                </form>
            </div>
        </div>

    </div>
@endsection

