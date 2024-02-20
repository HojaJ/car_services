@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</a>
        <div class="col-6 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('appointment.update', $data->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="modal-title" id="exampleModalLabel">{{ __("Edit") }}</h5>
                        <div class="form-group">
                            <label for="examplePercentage">{{ __('Worker') }}</label>
                            <select name="worker_id" class="form-control select2" style="width: 100%" required>
                                @foreach($workers as $worker)
                                    <option value="{{ $worker->id }}" @if($worker->id === $data->worker->id) selected @endif>{{ $worker->first_name }} {{ $worker->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="examplePercentage">{{ __('Client') }}</label>
                            <select name="user_id" class="form-control select2" style="width: 100%" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" @if($client->id === $data->user->id) selected @endif >{{ $client->first_name }} {{ $client->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start_time">{{ __('Start Time') }}</label>
                            <input type="datetime-local" id="start_time" class="form-control" name="start_time">
                        </div>
                        <div class="form-group">
                            <label for="finish_time">{{ __('Finish Time') }}</label>
                            <input type="datetime-local" id="finish_time" class="form-control" name="finish_time">
                        </div>

                        <div class="m-3">
                            <button type="submit" class="btn btn-primary d-inline-block">{{ __("Edit") }}</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
@endsection

