<div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th class="w-50">Nama Kategori</th>
                <th class="w-50">Icon</th>
                <th class="text-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($kategoris->isNotEmpty())
                @foreach ($kategoris as $dkat)
                    <tr>
                        <td>{{ $dkat->nama_kategori }}</td>
                        <td>{{ $dkat->icon }}</td>
                        <td>
                            <button type="button" wire:click="$emit('editKategori',{{ $dkat->id }})"
                                data-toggle="modal" data-target="#modalSetting"
                                class="btn btn-xs btn-warning">Ubah</button>
                            {{-- <button type="button" wire:click="$emit('deleteId',{{ $dkat->id }}, 1)"
                                data-toggle="modal" data-target="#deleteModal"
                                class="btn btn-xs btn-danger">Hapus</button> --}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="2">Belum ada data</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
