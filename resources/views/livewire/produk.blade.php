@section('title', 'Produk Ekraf')
@push('headscript')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/idekraf.css') }}" />
@endpush
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 py-4">
                <div class="input-group">
                    <input type="search" class="form-control form-control-lg" wire:model.live.debounce.250ms="search"
                        placeholder="Cari Produk">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Kategori Ekraf</h5>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" wire:model="radio_kategori" type="radio"
                                name="kategori" value="0" id="semuaKategori">
                            <label for="semuaKategori" class="custom-control-label">Semua Kategori</label>
                        </div>
                        @foreach ($kategoris as $dkat)
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" wire:model="radio_kategori" type="radio"
                                    value="{{ $dkat->id }}" name="kategori" id="kategori{{ $dkat->id }}">
                                <label for="kategori{{ $dkat->id }}"
                                    class="custom-control-label">{{ $dkat->nama_kategori }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card card-primary mb-4 card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Sektor Ekraf</h5>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="radio" name="jenis_usaha" id="semuaJenis"
                                wire:model="radio_jenis" value="0">
                            <label for="semuaJenis" class="custom-control-label">Semua Sektor</label>
                        </div>
                        @foreach ($jenis_usahas as $jus)
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" wire:model="radio_jenis" type="radio"
                                    name="jenis_usaha" value="{{ $jus->id }}" id="jenisUsaha{{ $jus->id }}">
                                <label for="jenisUsaha{{ $jus->id }}"
                                    class="custom-control-label">{{ $jus->jenis_usaha }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @if ($jenis_usaha_id != 0)
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <livewire:sektor-desc :jenis_usaha_id="$jenis_usaha_id" :key="$jenis_usaha_id" />
                        </div>
                    </div>
                @endif
                <livewire:produk-list :search_term="$search" :kat_id="$radio_kategori" :ju_id="$radio_jenis"
                    wire:key="produk-{{ $radio_jenis . $radio_kategori . $search }}">
            </div>
        </div>
    </div>
</div>
