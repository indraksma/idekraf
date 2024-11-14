@section('title', $ekraf->nama_usaha)
@push('headscript')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/idekraf.css') }}" />
@endpush
<div>
    <div class="container p-4">
        <div class="row justify-content-center">
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
                        <strong>Deskripsi</strong>
                        <p class="text-muted text-justify">
                            {{ $ekraf->deskripsi }}
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
            <div class="col-md-8">
                <div class="card card-success">
                    <div class="card-header">
                        Daftar Produk
                        <a href="{{ route('ekraf') }}" class="btn btn-secondary btn-xs float-right"><b>Kembali</b></a>
                    </div>
                    <div class="card-body">
                        @if ($produk->isNotEmpty())
                            <div class="row">
                                @foreach ($produk as $data)
                                    <div class="col-md-4">
                                        <a class="btn btn-light mb-2 btn-block" href="{{ url('produk/' . $data->id) }}">
                                            @if ($data->foto != null)
                                                <img src="{{ asset('storage/img/' . $data->foto) }}" class="img-fluid"
                                                    style="max-height: 100px" />
                                            @else
                                                <img src="{{ asset('img/default_product.png') }}" class="img-fluid"
                                                    style="max-height: 100px" />
                                            @endif
                                            <hr />
                                            {{ $data->nama_produk }}<br />
                                            <small>@rupiah($data->harga)</small><br />
                                        </a>
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    <div class="dataTables_paginate paging_simple_numbers ml-2">
                                        {{ $produk->links() }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-muted text-center">Belum Ada Produk</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
