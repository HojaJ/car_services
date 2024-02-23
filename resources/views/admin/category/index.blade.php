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
                            <th>{{ __('Name') }} tm</th>
                            <th>{{ __('Name') }} ru</th>
                            <th>{{ __('Name') }} en</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __("Action") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->name_tm }}</td>
                                <td>{{ $data->name_ru }}</td>
                                <td>{{ $data->name_en }}</td>
                                <td><a data-lightbox="image-1" href="{{ asset($data->image) }}"><img class="lazy"
                                                                                                     data-src="{{ asset($data->image) }}"
                                                                                                     height="20px"></a>
                                </td>
                                <td>
                                    <a href="{{route('category.edit', $data->id)}}"
                                       class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                                    </a>

                                    <form action="{{ route('category.destroy', $data->id) }}" method="POST"
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
                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Create') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name_tm">{{ __('Name') }} tm</label>
                            <input type="text" id="name_tm" class="form-control" name="name_tm"
                                   placeholder="{{ __('Name') }} tm" required>
                        </div>
                        <div class="form-group">
                            <label for="name_ru">{{ __('Name') }} ru</label>
                            <input type="text" id="name_ru" class="form-control" name="name_ru"
                                   placeholder="{{ __('Name') }} ru" required>
                        </div>
                        <div class="form-group">
                            <label for="name_en">{{ __('Name') }} en</label>
                            <input type="text" id="name_en" class="form-control" name="name_en"
                                   placeholder="{{ __('Name') }} en" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFile">{{ __('Image') }}</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFile"
                                   accept=".png, .jpg, .jpeg" required>
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
                    },
                    language: {
                        "decimal": "",
                        "emptyTable": '{{ __("Showing 0 to 0 of 0 entries") }}',
                        "info": '{{ __("Showing _START_ to _END_ of _TOTAL_ entries") }}',
                        "infoEmpty": '{{ __("Showing 0 to 0 of 0 entries") }}',
                        "infoFiltered": '{{ __("(filtered from _MAX_ total entries)") }}',
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": '{{ __("Show _MENU_ entries") }}',
                        "loadingRecords": '{{ __("Loading...") }}',
                        "processing": '{{ __('processing') }}',
                        "search": '{{ __("Search:") }}',
                        "zeroRecords": '{{ __("No matching records found") }}',
                        "paginate": {
                            "first": '{{ __("First") }}',
                            "last": '{{ __("Last") }}',
                            "next": '{{__("Next")}}',
                            "previous": '{{ __("Previous") }}'
                        },
                        "aria": {
                            "orderable": '{{ __("Order by this column") }}',
                            "orderableReverse": '{{ __('Reverse order this column') }}'
                        }
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
                                '{{ __('Cancelled') }}',
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