<div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th class="w-50">Jenis Usaha</th>
                <th class="w-50">Icon</th>
                <th class="text-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($ju->isNotEmpty())
                @foreach ($ju as $dju)
                    <tr>
                        <td>{{ $dju->jenis_usaha }}</td>
                        <td>{{ $dju->icon }}</td>
                        <td>
                            <button type="button" wire:click="$emit('editJenis',{{ $dju->id }})" data-toggle="modal"
                                data-target="#modalSetting" class="btn btn-xs btn-warning">Ubah</button>
                            <button type="button" wire:click="$emit('deleteId',{{ $dju->id }}, 2)"
                                data-toggle="modal" data-target="#deleteModal"
                                class="btn btn-xs btn-danger">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="3">Belum ada data</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="dataTables_paginate paging_simple_numbers ml-4">
        {{ $ju->links() }}
    </div>
</div>
