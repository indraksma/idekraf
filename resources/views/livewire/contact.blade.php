@section('title', 'Hubungi Kami')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 pt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('logo_idekraf.png') }}" class="img-fluid p-2" />
                            </div>
                            <div class="col-md-9">
                                <h4>Hubungi Kami</h4>
                                <span class="text-muted">Alamat</span><br />
                                <strong>Jl. Dipayuda No.30 A, Krandegan, Kec. Banjarnegara, Kab. Banjarnegara, Prov.
                                    Jawa
                                    Tengah. 53418</strong><br />
                                <span class="text-muted">Email</span><br />
                                <strong>baperlitbang@banjarnegarakab.go.id</strong><br />
                                <span class="text-muted">Telepon</span><br />
                                <strong>(0286) 591142</strong><br />
                                <span class="text-muted">Sosial Media</span><br />
                                <a href="{{ getInstagram() }}">Instagram</a>
                                <a href="{{ getYoutube() }}">Youtube</a>
                                <a href="{{ getTwitter() }}">Twitter</a>
                                <a href="{{ getFacebook() }}">Facebook</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
