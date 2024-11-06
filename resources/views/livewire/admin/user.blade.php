@section('title', 'User Management')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a class="text-teal" href="{{ route('admin') }}">Admin</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@push('bodyscript')
    <script>
        window.addEventListener('closeModalUser', event => {
            $('#modal-lg').modal('hide');
        });
        window.addEventListener('closeModalDelete', event => {
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-teal card-outline">
                <div class="card-body">
                    <button class="btn btn-success mb-3" wire:click="addUser" data-target="#modal-lg"
                        data-toggle="modal">Tambah
                        User</button>
                    <livewire:users-table />
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $modalTitle ? $modalTitle : 'User' }}</h4>
                    <button type="button" class="close" wire:click="resetForm" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="store()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input wire:model.lazy="name" type="text" class="form-control" id="namaLengkap"
                                placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input wire:model.lazy="email" type="email" class="form-control" id="inputEmail"
                                placeholder="email@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="inputNoHP">Nomor Handphone</label>
                            <input wire:model.lazy="no_hp" type="text" class="form-control" id="inputNoHP"
                                placeholder="Contoh : 080123456789" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <small>
                                {{ $reqpassword === false ? '(Opsional)' : '' }}
                            </small>
                            <input wire:model.lazy="password" type="password" class="form-control" id="inputPassword"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="inputRole">Role User</label>
                            <select class="form-control" wire:model="role" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($role_list as $data)
                                    <option value="{{ $data->id }}">{{ Str::ucfirst($data->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-default" wire:click="resetForm"
                            data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal Hapus -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" wire:click="resetForm" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin akan menghapus data tersebut?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="resetForm()" class="btn btn-dark close-btn"
                        data-dismiss="modal">Batal</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal">Ya,
                        Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
