@section('title', 'Ubah Password')
@section('content-header')
    <div class="row justify-content-center mb-2">
        <div class="col-sm-2">
            <h1 class="m-0">User</h1>
        </div><!-- /.col -->
        <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Ubah Password</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
<div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <form method="POST" wire:submit.prevent="store()">
                        <div class="form-group">
                            <label for="inputEmail">E-mail</label>
                            <input wire:model="email" type="text" class="form-control" id="inputEmail" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password Lama</label>
                            <input wire:model="oldPass" type="password"
                                class="form-control @if ($errorOldPass === true) is-invalid @elseif($errorOldPass === false) is-valid @endif"
                                id="inputPassword" placeholder="Password Lama" required>
                            @if ($errorOldPass)
                                <div class="alert alert-danger">{{ $errorMsg }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputNewPassword">Password Baru</label>
                            <input wire:model.lazy="newPass" type="password" class="form-control" id="inputNewPassword"
                                placeholder="Password Baru" minlength="8" required>
                        </div>
                        @if ($errorOldPass === false)
                            <button type="submit" class="btn btn-success">Simpan</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
