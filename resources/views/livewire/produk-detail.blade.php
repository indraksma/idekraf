@section('title', $produk->nama_produk)
@push('headscript')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/idekraf.css') }}" />
@endpush
<div>
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-success">
                    <div class="card-header">
                        Detail Produk
                        <a href="{{ route('produk') }}" class="btn btn-secondary btn-xs float-right"><b>Kembali</b></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <img src="{{ asset('storage/img/' . $produk->foto) }}" class="product-image"
                                    alt="Product Image">
                            </div>
                            <div class="col-12 col-sm-6" bis_skin_checked="1">
                                <h3 class="my-3">{{ $produk->nama_produk }}</h3>
                                <p class="text-justify">{{ $produk->deskripsi }}</p>

                                <hr>
                                <h5>Tipe Produk</h5>
                                <p>{{ $produk->tipe_produk }}</p>
                                <hr>
                                <h5>Potensi Ekspor</h5>
                                @if ($produk->ekspor)
                                    <h5><span class="badge badge-success">Ya</span></h5>
                                @else
                                    <h5><span class="badge badge-secondary">Tidak</span></h5>
                                @endif

                                <div class="bg-teal py-2 px-3 mt-4" bis_skin_checked="1">
                                    <h4 class="mb-0">
                                        @rupiah($produk->harga)
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-success card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if ($ekraf->logo != null)
                                <img class="profile-user-img img-fluid" src="{{ asset('storage/img/' . $ekraf->logo) }}"
                                    alt="Logo">
                            @else
                                <img class="profile-user-img img-fluid" src="{{ asset('img/default_store.png') }}"
                                    alt="Logo">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ $ekraf->nama_usaha }}</h3>

                        <p class="text-muted text-center mb-0">{{ $ekraf->kategori->nama_kategori }}</p>
                        <p class="text-center">{{ $ekraf->jenis_usaha->jenis_usaha }}</p>
                        <hr />
                        <strong>Nama Pemilik</strong>
                        <p class="text-muted text-justify">
                            {{ $ekraf->user->name }}
                        </p>
                        <hr />
                        <strong>Email</strong>
                        <p class="text-muted text-justify">
                            {{ $ekraf->user->email }}
                        </p>
                        @if ($ekraf->whatsapp != null)
                            <hr />
                            <strong>Whatsapp Usaha</strong>
                            <p class="text-muted text-justify">
                                {{ $ekraf->whatsapp }}
                            </p>
                        @endif
                        <hr />
                        <strong>Alamat</strong>
                        <p class="text-muted text-justify">
                            {{ $ekraf->alamat }}
                        </p>
                        <hr />
                        @if ($ekraf->website != null)
                            <a class="btn btn-sm btn-secondary mb-2" href="{{ $ekraf->website }}">Website</a>
                        @endif
                        @if ($ekraf->youtube != null)
                            <a class="btn btn-sm btn-danger mb-2" href="{{ $ekraf->youtube }}">Youtube</a>
                        @endif
                        @if ($ekraf->tiktok != null)
                            <a class="btn btn-sm btn-tiktok mb-2" href="{{ $ekraf->tiktok }}">Tiktok</a>
                        @endif
                        @if ($ekraf->instagram != null)
                            <a class="btn btn-sm btn-ig mb-2" href="{{ $ekraf->instagram }}">Instagram</a>
                        @endif
                        @if ($ekraf->facebook != null)
                            <a class="btn btn-sm btn-primary mb-2" href="{{ $ekraf->facebook }}">Facebook</a>
                        @endif
                        @if ($ekraf->twitter != null)
                            <a class="btn btn-sm btn-info mb-2" href="{{ $ekraf->twitter }}">Twitter | X</a>
                        @endif
                        @if ($ekraf->shopee != null)
                            <a class="btn btn-sm btn-shopee mb-2" href="{{ $ekraf->shopee }}">Shopee</a>
                        @endif
                        @if ($ekraf->tokopedia != null)
                            <a class="btn btn-sm btn-tokped mb-2" href="{{ $ekraf->tokopedia }}">Tokopedia</a>
                        @endif

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
