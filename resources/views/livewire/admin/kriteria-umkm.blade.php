<div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>Nama Kriteria</th>
                <th>Modal Minimal</th>
                <th>Modal Maksimal</th>
                <th class="text-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($kriterias->isNotEmpty())
                @foreach ($kriterias as $dkr)
                    <tr>
                        <td>{{ $dkr->name }}</td>
                        <td>{{ $dkr->min }}</td>
                        <td>{{ $dkr->max }}</td>
                        <td>
                            <button type="button" wire:click="$emit('editKriteria',{{ $dkr->id }})"
                                data-toggle="modal" data-target="#modalKriteria"
                                class="btn btn-xs btn-warning">Ubah</button>
                            <button type="button" wire:click="$emit('deleteId',{{ $dkr->id }},3)" data-toggle="modal"
                                data-target="#deleteModal" class="btn btn-xs btn-danger">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="4">Belum ada data</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
