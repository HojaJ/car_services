@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</a>
        <div class="col-6 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('worker.update', $data->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="modal-title" id="exampleModalLabel">{{ __("Edit") }}</h5>

                        <div class="form-group">
                            <label for="first_name">{{ __('First Name') }}</label>
                            <input type="text" id="first_name" class="form-control" name="first_name"
                                   placeholder="{{ __('First Name') }}" required value="{{$data->first_name}}">
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <input type="text" id="last_name" class="form-control" name="last_name"
                                   placeholder="{{ __('Last Name') }}" required value="{{$data->last_name}}">
                        </div>


                        <div class="form-group">
                            <label for="examplePercentage">{{ __('Category') }}</label>
                            <select name="category_id" class="form-control select2" style="width: 100%" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id === $data->category_id) selected @endif >{{ $category->{'name_'.app()->getLocale()} }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="profession_tm">{{ __('Profession') }} tm</label>
                            <input type="text" id="profession_tm" class="form-control" name="profession_tm"
                                   placeholder="{{ __('Profession') }} tm" required value="{{ $data->profession_tm }}">
                        </div>
                        <div class="form-group">
                            <label for="profession_ru">{{ __('Profession') }} ru</label>
                            <input type="text" id="profession_ru" class="form-control" name="profession_ru"
                                   placeholder="{{ __('Profession') }} ru" required value="{{ $data->profession_ru }}">
                        </div>
                        <div class="form-group">
                            <label for="profession_en">{{ __('Profession') }} en</label>
                            <input type="text" id="profession_en" class="form-control" name="profession_en"
                                   placeholder="{{ __('Profession') }} en" required value="{{ $data->profession_en }}">
                        </div>

                        <div class="form-group">
                            <label for="working_hours_start">{{ __('Working Hours Start') }}</label>
                            <input type="time" value="{{ $data->working_hours_start }}" id="working_hours_start" class="form-control"
                                   name="working_hours_start">
                        </div>
                        <div class="form-group">
                            <label for="working_hours_end">{{ __('Working Hours End') }}</label>
                            <input type="time" value="{{ $data->working_hours_end }}" id="working_hours_end" class="form-control"
                                   name="working_hours_end">
                        </div>

                </div>
                <div class="m-3">
                    <button type="submit" class="btn btn-primary d-inline-block">{{ __("Edit") }}</button>
                </div>

                </form>
            </div>
        </div>

    </div>
@endsection

