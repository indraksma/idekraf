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
        window.addEventListener('closeModalKriteria', event => {
            $('#modalKriteria').modal('hide');
        });
        window.addEventListener('closeModalDelete', event => {
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush
<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-teal card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link @if ($tabActive == 1) active @endif"
                                href="#kategori" data-toggle="tab" wire:click.prevent="changeTab('1')">Kategori
                                Usaha</a>
                        </li>
                        <li class="nav-item"><a class="nav-link @if ($tabActive == 2) active @endif"
                                href="#jenis" data-toggle="tab" wire:click.prevent="changeTab('2')">Jenis Usaha</a>
                        </li>
                        <li class="nav-item"><a class="nav-link @if ($tabActive == 4) active @endif"
                                href="#kriteria" data-toggle="tab" wire:click.prevent="changeTab('4')">Kriteria UMKM</a>
                        </li>
                        <li class="nav-item"><a class="nav-link @if ($tabActive == 3) active @endif"
                                href="#slider" data-toggle="tab" wire:click.prevent="changeTab('3')">Gambar Slider</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-0">
                    <div class="tab-content">
                        <div class="tab-pane @if ($tabActive == 1) active @endif" id="kategori">
                            {{-- <button class="btn btn-sm btn-success m-2" wire:click="addKategori"
                                data-target="#modalSetting" data-toggle="modal"><i class="fas fa-plus"></i>&nbsp;Tambah
                                Kategori</button> --}}
                            <livewire:admin.kategori />
                        </div>
                        <div class="tab-pane @if ($tabActive == 2) active @endif" id="jenis">
                            <button class="btn btn-sm btn-success m-2" wire:click="addJenis" data-target="#modalSetting"
                                data-toggle="modal"><i class="fas fa-plus"></i>&nbsp;Tambah
                                Jenis Usaha</button>
                            <livewire:admin.jenis-usaha />
                        </div>
                        <div class="tab-pane @if ($tabActive == 3) active @endif" id="slider">
                            <div class="p-4">
                                <div class="alert alert-info">Gambar Slider Harus Memiliki Resolusi / Rasio yang Sama.
                                    Direkomendasikan menggunakan resolusi 800 x 350 pixel. Ukuran maksimal yang
                                    diperbolehkan yaitu 2MB.
                                </div>
                                <form method="POST" wire:submit.prevent="storeSlider()">
                                    <div class="form-group">
                                        <label for="slider1">Slide 1</label>
                                        @if ($slide1)
                                            <img src="{{ asset('storage/img/' . $slide1->value) }}"
                                                class="img-fluid pb-2 d-block" style="max-width: 20vw;" />
                                        @endif
                                        <input wire:model="slider1" type="file" class="form-control"
                                            id="slider1" />
                                        <div wire:loading wire:target="slider1">Uploading...</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="slider2">Slide 2</label>
                                        @if ($slide2)
                                            <img src="{{ asset('storage/img/' . $slide2->value) }}"
                                                class="img-fluid pb-2 d-block" style="max-width: 20vw;" />
                                        @endif
                                        <input wire:model="slider2" type="file" class="form-control"
                                            id="slider2" />
                                        <div wire:loading wire:target="slider2">Uploading...</div>
                                    </div>
                                    <div class="form-group">
                                        @if ($slide3->value)
                                            <img src="{{ asset('storage/img/' . $slide3->value) }}"
                                                class="img-fluid pb-2 d-block" style="max-width: 20vw;" />
                                        @endif
                                        <label for="slider3">Slide 3</label>
                                        <input wire:model="slider3" type="file" class="form-control"
                                            id="slider3" />
                                        <div wire:loading wire:target="slider3">Uploading...</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane @if ($tabActive == 4) active @endif" id="kriteria">
                            <button class="btn btn-sm btn-success m-2" wire:click="addKriteria"
                                data-target="#modalKriteria" data-toggle="modal"><i class="fas fa-plus"></i>&nbsp;Tambah
                                Kriteria UMKM</button>
                            <livewire:admin.kriteria-umkm />
                        </div>
                    </div>
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
                                <input wire:model.lazy="kategori" type="text" class="form-control"
                                    id="namaKategori" placeholder="Nama Kategori" required>
                            </div>
                        @endif
                        @if (isset($jenisMode) && $jenisMode == true)
                            <div class="form-group">
                                <label for="jenisUsaha">Jenis Usaha</label>
                                <input wire:model.lazy="jenis_usaha" type="text" class="form-control"
                                    id="jenisUsaha" placeholder="Jenis Usaha" required>
                            </div>
                            <div class="form-group">
                                <label for="opdPengampu">OPD Pengampu</label>
                                <select wire:model="user_id" class="form-control" id="opdPengampu">
                                    <option value="">Tidak Ada</option>
                                    @if ($users->isNotEmpty())
                                        @foreach ($users as $usr)
                                            <option value="{{ $usr->id }}">{{ $usr->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
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

    <!-- Modal Kriteria -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="modalKriteria">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $modalTitle ? $modalTitle : ' Kriteria' }}</h4>
                    <button type="button" class="close" wire:click="resetForm" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="store()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaKriteria">Nama Kriteria</label>
                            <input wire:model.lazy="kriteria" type="text" class="form-control" id="namaKriteria"
                                placeholder="Nama Kriteria" required>
                        </div>
                        <div class="form-group">
                            <label for="modalMin">Modal Minimal</label>
                            <input wire:model.lazy="modal_min" type="number" class="form-control" id="modalMin"
                                placeholder="Modal Minimal" required>
                        </div>
                        <div class="form-group">
                            <label for="modalMax">Modal Maksimal</label>
                            <input wire:model.lazy="modal_max" type="number" class="form-control" id="modalMax"
                                placeholder="Modal Maksimal" required>
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
