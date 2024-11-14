@section('title', 'Verifikasi Ekraf')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Verifikasi Ekraf</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a class="text-teal" href="{{ route('admin') }}">
                        @if (Auth::user()->hasRole('admin'))
                            Admin
                        @elseif(Auth::user()->hasRole('opd'))
                            OPD
                        @endif
                    </a>
                </li>
                <li class="breadcrumb-item active">Ekraf</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@push('bodyscript')
    <script>
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
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>Nama Usaha</th>
                                <th>Nama Pemilik</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                            @if ($data->isNotEmpty())
                                @foreach ($data as $dt)
                                    <tr>
                                        <td>{{ $dt->nama_usaha }}</td>
                                        <td>{{ $dt->user->name }}</td>
                                        <td>{{ $dt->jenis_usaha->jenis_usaha }}</td>
                                        <td>{{ $dt->kategori->nama_kategori }}</td>
                                        <td>
                                            <button class="btn btn-xs btn-primary"
                                                wire:click="detailUsaha({{ $dt->id }})" data-toggle="modal"
                                                data-target="#detailModal">Detail</button>&nbsp;
                                            @if (Auth::user()->hasRole('admin') || Auth::user()->id == $dt->jenis_usaha->user_id)
                                                <button class="btn btn-xs btn-info"
                                                    wire:click="verifikasi({{ $dt->id }})">Verifikasi</button>&nbsp;
                                                <button class="btn btn-xs btn-danger"
                                                    wire:click="deleteId({{ $dt->id }})" data-toggle="modal"
                                                    data-target="#deleteModal">Hapus</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="detailModal">
        <div class="modal-dialog modal-lg">
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
                        <div class="text-center  mb-2">
                            @if ($filelogo != null)
                                <img class="profile-user-img img-fluid" src="{{ asset('storage/img/' . $filelogo) }}"
                                    alt="User profile picture">
                            @else
                                <img class="profile-user-img img-fluid" src="{{ asset('img/default_store.png') }}"
                                    alt="User profile picture">
                            @endif
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nama Usaha</strong>
                                <p class="text-muted mb-0">{{ $nama_usaha }}</p>
                                <hr class="mb-1 mt-1">
                                <strong>Kategori</strong>
                                <p class="text-muted mb-0">{{ $nama_kategori }}</p>
                                <hr class="mb-1 mt-1">
                                <strong>Nomor HP</strong>
                                <p class="text-muted mb-0">{{ $no_hp }}</p>
                                <hr class="mb-1 mt-1">
                                <strong>Nomor Whatsapp Usaha</strong>
                                <p class="text-muted mb-0">
                                    @if ($whatsapp != null)
                                        {{ $no_hp }}
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Website</strong>
                                <p class="text-muted mb-0">
                                    @if ($website != null)
                                        {{ $website }}
                                        <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                            href="{{ $website }}">Buka</a>
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Tiktok</strong>
                                <p class="text-muted mb-0">
                                    @if ($tiktok != null)
                                        {{ $tiktok }}
                                        <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                            href="{{ $tiktok }}">Buka</a>
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Facebook</strong>
                                <p class="text-muted mb-0">
                                    @if ($facebook != null)
                                        {{ $facebook }}
                                        <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                            href="{{ $facebook }}">Buka</a>
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Shopee</strong>
                                <p class="text-muted mb-0">
                                    @if ($shopee != null)
                                        {{ $shopee }}
                                        <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                            href="{{ $shopee }}">Buka</a>
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Alamat</strong>
                                <p class="text-muted mb-0">{{ $alamat }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Nama Pemilik</strong>
                                <p class="text-muted mb-0">{{ $name }}</p>
                                <hr class="mb-1 mt-1">
                                <strong>Jenis Usaha</strong>
                                <p class="text-muted mb-0">{{ $nama_jenis }}</p>
                                <hr class="mb-1 mt-1">
                                <strong>Email</strong>
                                <p class="text-muted mb-0">{{ $email }}</p>
                                <hr class="mb-1 mt-1">
                                <strong>Link Maps</strong>
                                <p class="text-muted mb-0">
                                    @if ($link_maps != null)
                                        {{ $link_maps }}
                                        <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                            href="{{ $link_maps }}">Buka</a>
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Youtube</strong>
                                <p class="text-muted mb-0">
                                    @if ($youtube != null)
                                        {{ $youtube }}
                                        <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                            href="{{ $youtube }}">Buka</a>
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Instagram</strong>
                                <p class="text-muted mb-0">
                                    @if ($instagram != null)
                                        {{ $instagram }}
                                        <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                            href="{{ $instagram }}">Buka</a>
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Twitter / X</strong>
                                <p class="text-muted mb-0">
                                    @if ($twitter != null)
                                        {{ $twitter }}
                                        <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                            href="{{ $twitter }}">Buka</a>
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Tokopedia</strong>
                                <p class="text-muted mb-0">
                                    @if ($tokopedia != null)
                                        {{ $tokopedia }}
                                        <a target="_blank" class="ml-2 btn btn-xs btn-info"
                                            href="{{ $tokopedia }}">Buka</a>
                                    @else
                                        -
                                    @endif
                                </p>
                                <hr class="mb-1 mt-1">
                                <strong>Deskripsi</strong>
                                <p class="text-muted">{{ $deskripsi }}</p>
                            </div>
                        </div>
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
                        data user yang telah dibuat. Untuk menghapus user pemilik usaha silahkan hapus melalui halaman
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
</div>
