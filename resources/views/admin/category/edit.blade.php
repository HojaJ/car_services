@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</a>
    <div class="col-6 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('category.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("Edit") }}</h5>


                    <div class="form-group">
                        <label for="name_tm">{{ __('Name') }} tm</label>
                        <input type="text" id="name_tm" class="form-control" name="name_tm" value="{{ $data->name_tm }}" placeholder="{{ __('Name') }} tm" required>
                    </div>

                    <div class="form-group">
                        <label for="name_ru">{{ __('Name') }} ru</label>
                        <input type="text" id="name_ru" class="form-control" name="name_ru"  value="{{ $data->name_ru }}" placeholder="{{ __('Name') }} ru" required>
                    </div>
                    <div class="form-group">
                        <label for="name_en">{{ __('Name') }} en</label>
                        <input type="text" id="name_en" class="form-control" name="name_en"  value="{{ $data->name_en }}" placeholder="{{ __('Name') }} en" required>
                    </div>



                    <div class="row form-group">
                        <div class="col">                                                
                            <label for="exampleFile">{{ __("Image") }}</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFile" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="col pt-3">
                            <img src="{{ asset($data->image) }}" height="50px">
                        </div>
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

