@section('title', 'Setting Sistem')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Setting Sistem</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a class="text-teal" href="{{ route('admin') }}">Admin</a></li>
                <li class="breadcrumb-item active">Setting</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@push('headscript')
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
    </style>
@endpush
@push('bodyscript')
    <script>
        window.addEventListener('closeModalSetting', event => {
            $('#modalSetting').modal('hide');
        });
        window.addEventListener('closeModalDelete', event => {
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush
<div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Kategori Usaha</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-sm btn-success" wire:click="addKategori" data-target="#modalSetting"
                                data-toggle="modal">Tambah
                                Kategori</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <livewire:admin.kategori />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-teal card-outline">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Jenis Usaha</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-sm btn-success" wire:click="addJenis" data-target="#modalSetting"
                                data-toggle="modal">Tambah
                                Jenis Usaha</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <livewire:admin.jenis-usaha />
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="modalSetting">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $modalTitle ? $modalTitle : 'Kategori / Jenis Usaha' }}</h4>
                    <button type="button" class="close" wire:click="resetForm" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="store()">
                    <div class="modal-body">
                        @if (isset($kategoriMode) && $kategoriMode == true)
                            <div class="form-group">
                                <label for="namaKategori">Nama Kategori</label>
                                <input wire:model.lazy="kategori" type="text" class="form-control" id="namaKategori"
                                    placeholder="Nama Kategori" required>
                            </div>
                        @endif
                        @if (isset($jenisMode) && $jenisMode == true)
                            <div class="form-group">
                                <label for="jenisUsaha">Jenis Usaha</label>
                                <input wire:model.lazy="jenis_usaha" type="text" class="form-control" id="jenisUsaha"
                                    placeholder="Jenis Usaha" required>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="iconFA">Icon</label>
                            <input wire:model.lazy="icon" type="text" class="form-control" id="iconFA"
                                placeholder="fas fa-icon" required>
                        </div>
                        <div class="alert alert-info mb-0">
                            <small class="mb-0">
                                Kode icon dapat dicari pada website <a href="https://fontawesome.com/v5/search">Font
                                    Awesome</a>. Silahkan gunakan kode yang berformat seperti : fas fa-book; far
                                fa-book; tanpa menyertakan tag htmlnya.
                            </small>
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
