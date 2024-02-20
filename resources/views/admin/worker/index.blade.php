@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addItem">
                {{ __('Create') }}
            </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('First Name') }}</th>
                            <th>{{ __('Last Name') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Profession') }} tm</th>
                            <th>{{ __('Profession') }} ru</th>
                            <th>{{ __('Profession') }} en</th>
                            <th>{{ __('Working Hours Start') }}</th>
                            <th>{{ __('Working Hours End') }}</th>
                            <th>{{ __('Calendar') }}</th>
                            <th>{{ __("Action") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->first_name }}</td>
                                <td>{{ $data->last_name }}</td>
                                <td>{{ $data->category->{'name_'.app()->getLocale()} }}</td>
                                <td>{{ $data->profession_tm }}</td>
                                <td>{{ $data->profession_ru }}</td>
                                <td>{{ $data->profession_en }}</td>
                                <td>{{ $data->working_hours_start }}</td>
                                <td>{{ $data->working_hours_end }}</td>
                                <td><a target="_blank" href="{{ route('admin.calendar', $data->id) }}">{{ __('Calendar') }}</a></td>

                                <td>
                                    <a href="{{route('worker.edit', $data->id)}}"
                                       class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                                    </a>

                                    <form action="{{ route('worker.destroy', $data->id) }}" method="POST"
                                          class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white"
                                           id="poz-buton-{{$data->id}}">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-top:100px;">
            <div class="modal-content">
                <form action="{{ route('worker.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Create') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="first_name">{{ __('First Name') }}</label>
                            <input type="text" id="first_name" class="form-control" name="first_name"
                                   placeholder="{{ __('First Name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <input type="text" id="last_name" class="form-control" name="last_name"
                                   placeholder="{{ __('Last Name') }}" required>
                        </div>


                        <div class="form-group">
                            <label for="examplePercentage">{{ __('Category') }}</label>
                            <select name="category_id" class="form-control select2" style="width: 100%" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->{'name_'.app()->getLocale()} }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="profession_tm">{{ __('Profession') }} tm</label>
                            <input type="text" id="profession_tm" class="form-control" name="profession_tm"
                                   placeholder="{{ __('Profession') }} tm" required>
                        </div>
                        <div class="form-group">
                            <label for="profession_ru">{{ __('Profession') }} ru</label>
                            <input type="text" id="profession_ru" class="form-control" name="profession_ru"
                                   placeholder="{{ __('Profession') }} ru" required>
                        </div>
                        <div class="form-group">
                            <label for="profession_en">{{ __('Profession') }} en</label>
                            <input type="text" id="profession_en" class="form-control" name="profession_en"
                                   placeholder="{{ __('Profession') }} en" required>
                        </div>

                        <div class="form-group">
                            <label for="working_hours_start">{{ __('Working Hours Start') }}</label>
                            <input type="time" value="08:00" id="working_hours_start" step="1800" class="form-control" name="working_hours_start">
                        </div>
                        <div class="form-group">
                            <label for="working_hours_end">{{ __('Working Hours End') }}</label>
                            <input type="time" value="20:00" id="working_hours_end" step="1800" class="form-control" name="working_hours_end">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</button>
                        <button type="submit" class="btn btn-primary">{{ __("Create") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    @push('scripts')
        <script type="text/javascript">
            $(function () {
                var lazyLoadInstance = new LazyLoad({});
                $('#dataTable').DataTable({
                    stateSave: true,
                    drawCallback: function () {
                        lazyLoadInstance.update();
                    }
                });

                $('#dataTable tbody').on('click', "[id^='poz-buton-']", function (event) {
                    var id = $(this).attr('id');
                    id = id.replace("poz-buton-", '');
                    event.preventDefault();
                    Swal.fire({
                        title: "{{ __("Delete") }}?",
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: '#0CC27E',
                        cancelButtonColor: '#FF586B',
                        confirmButtonText: '{{ __("Yes") }}',
                        cancelButtonText: '{{ __('Cancel') }}!',
                        confirmButtonClass: 'btn btn-success ml-1',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#poz-buton-' + id).parent().submit();
                        } else {
                            Swal.fire(
                                'Cancelled',
                                '{{ __("Cancel") }}',
                                'error'
                            )
                        }
                    })
                });
            });

        </script>

    @endpush
@endsection