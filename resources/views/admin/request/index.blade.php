@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('Worker') }}</th>
                            <th>{{ __('Client') }}</th>
                            <th>{{ __('Start time') }}</th>
                            <th>{{ __('Finish time') }}</th>
                            <th>{{ __('Comment') }}</th>
                            <th>{{ __("Action") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td><a href="{{ route('worker.edit', $data->worker->id) }}" target="_blank">{{ $data->worker->first_name }} {{ $data->worker->last_name }}</a></td>
                                <td><a href="{{ route('admin.edit', $data->user->id) }}" target="_blank">{{ $data->user->first_name }} {{ $data->user->last_name }}</a></td>
                                <td>{{ $data->start_time }}</td>
                                <td>{{ $data->finish_time }}</td>
                                <td>{{ $data->note }}</td>
                                <td>
                                    <form action="{{ route('request.destroy', $data->id) }}" method="POST"
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