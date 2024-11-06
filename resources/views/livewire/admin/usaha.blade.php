@section('title', 'Data Ekraf')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Data Ekraf</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a class="text-teal" href="{{ route('admin') }}">Admin</a></li>
                <li class="breadcrumb-item active">Ekraf</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@push('bodyscript')
    <script>
        window.addEventListener('closeModalEkraf', event => {
            $('#ekrafModal').modal('hide');
        });
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
    @if (Auth::user()->hasRole('admin'))
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-teal card-outline">
                    <div class="card-body">
                        <button class="btn btn-success mb-3" wire:click="addEkraf" data-target="#ekrafModal"
                            data-toggle="modal">Tambah
                            Ekraf</button>
                        <livewire:ekraf-table />
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Produk --}}
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
                    <form method="POST" wire:submit.prevent="storeProduk()">
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
                                        <input wire:model.lazy="harga" type="int" class="form-control"
                                            id="harga" placeholder="123456" required>
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
                                            @if ($editMode === true)
                                                @if (isset($fileProduk))
                                                    &emsp;
                                                    <a target="_blank" class="right btn btn-xs btn-info"
                                                        href="{{ asset('storage/img/' . $fileProduk) }}">Lihat</a>
                                                @endif
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

        <div wire:ignore.self class="modal fade" data-backdrop="static" id="ekrafModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $modalTitle ? $modalTitle : 'Ekraf' }}</h4>
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
                                        <label for="kategoriEkraf">Kategori Ekraf</label>
                                        <select class="form-control" id="kategoriEkraf" wire:model="kategori_id"
                                            required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($kategori as $dkat)
                                                <option value="{{ $dkat->id }}">
                                                    {{ Str::ucfirst($dkat->nama_kategori) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenisEkraf">Jenis Ekraf</label>
                                        <select class="form-control" id="jenisEkraf" wire:model="jenis_usaha_id"
                                            required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($jenis_usaha as $djenis)
                                                <option value="{{ $djenis->id }}">
                                                    {{ Str::ucfirst($djenis->jenis_usaha) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namaUsaha">Nama Usaha</label>
                                        <input wire:model.lazy="nama_usaha" type="text" class="form-control"
                                            id="namaUsaha" placeholder="Nama Usaha" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fileLogo">Logo <small>(JEPG/PNG. Max 1MB)</small>
                                            @if ($editMode === true)
                                                &emsp;
                                                <a target="_blank" class="right btn btn-xs btn-info"
                                                    href="{{ asset('storage/img/' . $filelogo) }}">Lihat</a>
                                            @endif
                                        </label>
                                        <input wire:model="logo" type="file"
                                            class="form-control @error('logo') is-invalid @enderror"
                                            accept="image/png, image/jpeg" id="fileLogo">
                                        @error('logo')
                                            <div class="alert alert-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Alamat">Alamat</label>
                                        <textarea wire:model.lazy="alamat" class="form-control" id="Alamat" rows="2" required>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Deskripsi">Deskripsi</label>
                                        <textarea wire:model.lazy="deskripsi" class="form-control" id="Deskripsi" rows="3" required>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="linkWeb">Website</label>
                                        <input wire:model.lazy="website" type="text" class="form-control"
                                            id="linkWeb" placeholder="Link Website" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="linkMaps">Link Google Maps</label>
                                        <input wire:model.lazy="link_maps" type="text" class="form-control"
                                            id="linkMaps" placeholder="Link Google Maps" required>
                                    </div>
                                </div>
                                @if ($editMode === false)
                                    <div class="col-12">
                                        <hr />
                                        <h5>Data Pemilik Usaha</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namaLengkap">Nama Lengkap</label>
                                            <input wire:model.lazy="name" type="text" class="form-control"
                                                id="namaLengkap" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail">Email</label>
                                            <input wire:model.lazy="email" type="email" class="form-control"
                                                id="inputEmail" placeholder="email@email.com" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputNoHP">Nomor Handphone</label>
                                            <input wire:model.lazy="no_hp" type="text" class="form-control"
                                                id="inputNoHP" placeholder="Contoh : 080123456789" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputPassword">Password <small>(Untuk Login
                                                    User)</small></label>
                                            <input wire:model.lazy="password" type="password" class="form-control"
                                                id="inputPassword" placeholder="Password">
                                        </div>
                                    </div>
                                @endif
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

        <!-- Modal Detail -->
        <div wire:ignore.self class="modal fade" data-backdrop="static" id="detailModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Ekraf</h5>
                        <button type="button" class="close" wire:click="resetForm" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($detailMode)
                            <div class="text-center">
                                <img class="profile-user-img img-fluid" src="{{ asset('storage/img/' . $filelogo) }}"
                                    alt="User profile picture">
                            </div>
                            <strong>Nama Usaha</strong>
                            <p class="text-muted mb-0">{{ $nama_usaha }}</p>
                            <hr class="mb-1 mt-1">
                            <strong>Nama Pemilik</strong>
                            <p class="text-muted mb-0">{{ $name }}</p>
                            <hr class="mb-1 mt-1">
                            <strong>Kategori</strong>
                            <p class="text-muted mb-0">{{ $nama_kategori }}</p>
                            <hr class="mb-1 mt-1">
                            <strong>Jenis Usaha</strong>
                            <p class="text-muted mb-0">{{ $nama_jenis }}</p>
                            <hr class="mb-1 mt-1">
                            <strong>Nomor HP</strong>
                            <p class="text-muted mb-0">{{ $no_hp }}</p>
                            <hr class="mb-1 mt-1">
                            <strong>Email</strong>
                            <p class="text-muted mb-0">{{ $email }}</p>
                            <hr class="mb-1 mt-1">
                            <strong>Website</strong>
                            <p class="text-muted mb-0">
                                {{ $website }}
                                <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                    href="{{ $website }}">Buka</a>
                            </p>
                            <hr class="mb-1 mt-1">
                            <strong>Alamat</strong>
                            <p class="text-muted mb-0">{{ $alamat }}</p>
                            <hr class="mb-1 mt-1">
                            <strong>Link Maps</strong>
                            <p class="text-muted mb-0">
                                {{ $link_maps }}
                                <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                    href="{{ $link_maps }}">Buka</a>
                            </p>
                            <hr class="mb-1 mt-1">
                            <strong>Deskripsi</strong>
                            <p class="text-muted">{{ $deskripsi }}</p>
                            <button wire:click="resetForm" data-dismiss="modal"
                                class="btn btn-secondary btn-block">Tutup</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

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
                        <div class="alert alert-warning">
                            Menghapus data ekraf tidak termasuk menghapus
                            data user yang telah dibuat. Untuk menghapus user pemilik usaha silahkan hapus melalui
                            halaman
                            <a class="btn btn-xs btn-success" style="text-decoration: none;"
                                href="{{ route('admin.user') }}">User</a>
                        </div>
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
    @else
        <div class="row justify-content-center">
            @if ($cekverifikasi == 0)
                <div class="col-md-12">
                    <div class="alert alert-info">Anda belum menambahkan data usaha / ekraf. Silahkan lengkapi data
                        berikut untuk menambahkan data usaha Anda.</div>
                </div>
            @elseif($cekverifikasi == 2)
                <div class="col-md-12">
                    <div class="alert alert-warning">Data usaha Anda sedang dalam proses verifikasi Admin.</div>
                </div>
            @endif
            <div class="col-md-12">
                <div class="card card-teal card-outline">
                    <div class="card-body">
                        <form method="POST" wire:submit.prevent="store()">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kategoriEkraf">Kategori Ekraf</label>
                                        <select class="form-control" id="kategoriEkraf" wire:model="kategori_id"
                                            required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($kategori as $dkat)
                                                <option value="{{ $dkat->id }}">
                                                    {{ Str::ucfirst($dkat->nama_kategori) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenisEkraf">Jenis Ekraf</label>
                                        <select class="form-control" id="jenisEkraf" wire:model="jenis_usaha_id"
                                            required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($jenis_usaha as $djenis)
                                                <option value="{{ $djenis->id }}">
                                                    {{ Str::ucfirst($djenis->jenis_usaha) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namaUsaha">Nama Usaha</label>
                                        <input wire:model.lazy="nama_usaha" type="text" class="form-control"
                                            id="namaUsaha" placeholder="Nama Usaha" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fileLogo">Logo <small>(JEPG/PNG. Max 1MB)</small>
                                            @if ($editMode === true)
                                                &emsp;
                                                <a target="_blank" class="right btn btn-xs btn-info"
                                                    href="{{ asset('storage/img/' . $filelogo) }}">Lihat</a>
                                            @endif
                                        </label>
                                        <input wire:model="logo" type="file"
                                            class="form-control @error('logo') is-invalid @enderror"
                                            accept="image/png, image/jpeg" id="fileLogo">
                                        @error('logo')
                                            <div class="alert alert-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Alamat">Alamat</label>
                                        <textarea wire:model.lazy="alamat" class="form-control" id="Alamat" rows="2" required>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Deskripsi">Deskripsi</label>
                                        <textarea wire:model.lazy="deskripsi" class="form-control" id="Deskripsi" rows="3" required>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="linkWeb">Website</label>
                                        <input wire:model.lazy="website" type="text" class="form-control"
                                            id="linkWeb" placeholder="Link Website" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="linkMaps">Link Google Maps</label>
                                        <input wire:model.lazy="link_maps" type="text" class="form-control"
                                            id="linkMaps" placeholder="Link Google Maps" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
