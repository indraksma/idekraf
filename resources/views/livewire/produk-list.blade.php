<div>
    <div class="ekraf-list">
        <div class="direktori-baru index-main-content">
            <div class="head">
                Semua Produk
                @if ($searchTerm)
                    {{ '"' . $searchTerm . '"' }}
                @endif
            </div>
            <div class="row">
                @foreach ($produk as $dir)
                    <div class="col-lg-4 col-md-6">
                        <a class="box media" href="{{ url('/produk/' . $dir->id) }}">
                            @if ($dir->foto == null)
                                <img width="64" class="rounded" src="{{ asset('img/default_product.png') }}">
                            @else
                                <img width="64" class="rounded" src="{{ asset('storage/img/' . $dir->foto) }}">
                            @endif
                            <div class="media-box">
                                <div class="title">{{ $dir->nama_produk }}</div>
                                <p>
                                    <span>{{ $dir->nama_usaha }}</span><br>
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="dataTables_paginate paging_simple_numbers ml-4">
        {{ $produk->links() }}
    </div>
</div>
