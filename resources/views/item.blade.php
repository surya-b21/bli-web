@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger text-center" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Item List') }}</div>

                    <div class="card-body">
                        @if (Auth::user()->role_id == 3)
                            <div class="text-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Tambah Item
                                </button>
                            </div>
                        @endif
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTitle">Tambah item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('item.store') }}" method="POST">
                        @csrf
                        @if (Auth::user()->role_id == 3)
                            <div class="mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku" id="sku">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga">
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stok" id="stok">
                        </div>
                        @if (Auth::user()->role_id == 3)
                            <div class="mb-3">
                                <label class="form-label">Unit Of Material</label>
                                <input type="text" class="form-control" name="unit_of_material" id="unit_of_material">
                            </div>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit" onclick="$('form').submit()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        edit()

        function edit() {
            $(document).on('click','#edit', function () {
                $('#modalTitle').html("Edit Item")
                $('#submit').html("Save Changes")
                $('form').attr('action', $(this).data('url'))

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("item.data") }}',
                    data: {
                        id: $(this).data('id')
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        $("#sku").val(data.sku)
                        $("#nama").val(data.nama)
                        $("#harga").val(data.harga)
                        $("#stok").val(data.stok)
                        $("#unit_of_material").val(data.unit_of_material)
                    }
                })
            })
        }
    </script>
@endpush
