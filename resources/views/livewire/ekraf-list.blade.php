<div>
    <div class="ekraf-list">
        <div class="direktori-baru index-main-content">
            <div class="head">
                Semua
                @if ($searchTerm)
                    {{ '"' . $searchTerm . '"' }}
                @endif
            </div>
            <div class="row">
                @foreach ($ekraf as $dir)
                    <div class="col-lg-4 col-md-6">
                        <a class="box media" href="{{ url('/ekraf/' . $dir->id) }}">
                            @if ($dir->logo == null)
                                <img width="64" class="rounded" src="{{ asset('img/default_store.png') }}">
                            @else
                                <img width="64" class="rounded" src="{{ asset('storage/img/' . $dir->logo) }}">
                            @endif
                            <div class="media-box">
                                <div class="title">{{ $dir->nama_usaha }}</div>
                                <p>
                                    <span>{{ $dir->kategori->nama_kategori }}</span><br>
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="dataTables_paginate paging_simple_numbers ml-4">
        {{ $ekraf->links() }}
    </div>
</div>
