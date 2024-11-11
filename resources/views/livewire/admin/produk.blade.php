@section('title', 'Produk')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Daftar Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a class="text-teal" href="{{ route('admin') }}">Admin</a></li>
                <li class="breadcrumb-item active">Produk</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@push('bodyscript')
    <script>
        window.addEventListener('closeModalProduk', event => {
            $('#produkModal').modal('hide');
        });
        window.addEventListener('closeModalDetail', event => {
            $('#detailModal').modal('hide');
        });
        window.addEventListener('closeModalDelete', event => {
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush
<div>
    <div class="row justify-content-center">
        @if ($cekverifikasi == 1)
            <div class="col-md-12">
                <div class="card card-teal card-outline">
                    <div class="card-body">
                        <div class="row">
                            @if (Auth::user()->hasRole('user'))
                                <div class="col-12">
                                    <button type="button" class="btn btn-success mb-3" data-toggle="modal"
                                        data-target="#produkModal" wire:click="addProduk()">Tambah Produk</button>
                                </div>
                            @endif
                            <div class="col-12">
                                <livewire:produk-table />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="alert alert-warning">
                    @if ($cekverifikasi == 0)
                        Anda belum menambahkan data usaha. Silahkan tambahkan data usaha anda pada halaman <a
                            href="{{ route('admin.usaha') }}">Ekraf</a>
                    @elseif($cekverifikasi == 2)
                        Anda belum dapat menambahkan produk karena data usaha anda belum diverifikasi oleh Admin. Harap
                        menunggu proses verifikasi selesai
                        dilakukan oleh Admin.
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Tambah Produk Bagi User -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="produkModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4>
                    <button type="button" class="close" wire:click="resetForm" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="store()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaUsaha">Nama Usaha</label>
                                    <input wire:model.lazy="nama_usaha" type="text" class="form-control"
                                        id="namaUsaha" placeholder="Nama Usaha" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaProduk">Nama Produk</label>
                                    <input wire:model.lazy="nama_produk" type="text" class="form-control"
                                        id="namaProduk" placeholder="Nama Produk" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipeProduk">Tipe Produk</label>
                                    <input wire:model.lazy="tipe_produk" type="text" class="form-control"
                                        id="tipeProduk" placeholder="Tipe Produk" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input wire:model.lazy="harga" type="int" class="form-control" id="harga"
                                        placeholder="123456" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ekspor">Potensi Ekspor</label>
                                    <select wire:model.lazy="ekspor" class="form-control" id="ekspor" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fileProduk">Foto Produk <small>(JEPG/PNG. Max 1MB)</small>
                                        @if ($editMode === true && $fileProduk != null)
                                            &emsp;
                                            <a target="_blank" class="right btn btn-xs btn-info"
                                                href="{{ asset('storage/img/' . $fileProduk) }}">Lihat</a>
                                        @endif
                                    </label>
                                    <input wire:model="foto_produk" type="file"
                                        class="form-control @error('foto_produk') is-invalid @enderror"
                                        accept="image/png, image/jpeg" id="fileProduk">
                                    @error('foto_produk')
                                        <div class="alert alert-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Deskripsi">Deskripsi</label>
                                    <textarea wire:model.lazy="deskripsi_produk" class="form-control" id="Deskripsi" rows="3" required>
                                    </textarea>
                                </div>
                            </div>
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
                    <p>
                        Apakah Anda yakin akan menghapus data tersebut?
                    </p>
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

    <!-- Modal Detail -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="detailModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Produk</h5>
                    <button type="button" class="close" wire:click="resetForm" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($detailMode)
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                @if ($fileProduk != null)
                                    <img class="img-fluid mb-3" src="{{ asset('storage/img/' . $fileProduk) }}"
                                        alt="Product Picture">
                                @else
                                    <img class="img-fluid mb-3" src="{{ asset('img/default_product.png') }}"
                                        alt="Product Picture">
                                @endif
                            </div>
                        </div>
                        <strong>Nama Produk</strong>
                        <p class="text-muted mb-0">{{ $nama_produk }}</p>
                        <hr class="mb-1 mt-1">
                        <strong>Nama Usaha</strong>
                        <p class="text-muted mb-0">{{ $nama_usaha }}</p>
                        <hr class="mb-1 mt-1">
                        <strong>Tipe Produk</strong>
                        <p class="text-muted mb-0">{{ $tipe_produk }}</p>
                        <hr class="mb-1 mt-1">
                        <strong>Harga</strong>
                        <p class="text-muted mb-0">{{ $harga }}</p>
                        <hr class="mb-1 mt-1">
                        <strong>Potensi Ekspor</strong>
                        <p class="text-muted mb-0">
                            @if ($ekspor == 0)
                                Tidak
                            @elseif($ekspor == 1)
                                Ya
                            @endif
                        </p>
                        <hr class="mb-1 mt-1">
                        <strong>Deskripsi</strong>
                        <p class="text-muted">{{ $deskripsi_produk }}</p>
                        <button wire:click="resetForm" data-dismiss="modal"
                            class="btn btn-secondary btn-block">Tutup</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
