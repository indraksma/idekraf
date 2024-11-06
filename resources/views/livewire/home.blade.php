@section('title', 'Home')
@push('headscript')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/idekraf.css') }}" />
@endpush
@push('bodyscript')
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.slick-slider').slick({
                autoplay: true,
                autoplaySpeed: 5000,
                infinite: true,
                dots: true,
            });
        });
    </script>
@endpush
<div>
    <div class="index-top">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mt-4">
                    <div class="slick-slider">
                        <div><img src="{{ asset('img/idekraf-banner.jpg') }}" class="img-fluid img-rounded w-100"></div>
                        <div><img src="{{ asset('img/idekraf-banner-2.jpg') }}" class="img-fluid img-rounded w-100">
                        </div>
                    </div>
                </div>
                <div class="col-md-10 mb-4">
                    <div class="direktori-kreasi m-0">
                        <div class="head text-center">
                            <span>Direktori Kreasi Banjarnegara</span>
                        </div>
                        <div class="kategori">
                            <div class="row">
                                @foreach ($kategoris as $kat)
                                    <div class="col col-lg-3 col-sm-6">
                                        <a class="direktori-box" href="{{ url('/ekraf?kategori_id=' . $kat->id) }}">
                                            <div class="icon text-teal">
                                                <i class="{{ $kat->icon }}"></i>
                                            </div>
                                            <div class="title text-teal">{{ $kat->nama_kategori }}</div>
                                            <span>{{ $kat->usaha()->where('isVerified', true)->count() }} orang</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="index-main">
        <div class="container">
            <div class="totals-section">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <a href="{{ url('/ekraf') }}" class="totals-item">
                            <img src="{{ asset('img/usaha.png') }}">
                            <b>{{ $total_usaha }}</b>
                            <span>Usaha</span>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <a href="{{ url('/produk') }}" class="totals-item">
                            <img src="{{ asset('img/produk.png') }}">
                            <b>{{ $total_produk }}</b>
                            <span>Produk</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="sub-sektor index-main-content">
                <div class="head text-center">
                    <span>{{ $jenis_usaha }}</span> Sub Sektor
                </div>
                <div class="row">
                    @foreach ($jenis_usahas as $ju)
                        <div class="col col-flex col-lg-2 col-md-3 col-sm-6 col-6">
                            <a class="direktori-box" href="{{ url('/ekraf?jenis_usaha_id=' . $ju->id) }}">
                                <div class="icon">
                                    <i class="{{ $ju->icon }}"></i>
                                </div>
                                <div class="title">{{ $ju->jenis_usaha }}</div>
                                <span>{{ $ju->usaha()->count() }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="direktori-baru index-main-content">
                <div class="head">
                    Direktori Terbaru
                    <a href="{{ url('/ekraf') }}">Lihat Semua &gt;</a>
                </div>
                <div class="row">
                    @foreach ($direktori_baru as $dir)
                        <div class="col-lg-3 col-md-6">
                            <a class="box media" href="{{ url('/ekraf/' . $dir->id) }}">
                                <img width="64" class="rounded" src="{{ asset('storage/img/' . $dir->logo) }}">
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
    </div>

</div>
