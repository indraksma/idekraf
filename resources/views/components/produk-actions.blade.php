<div class="btn-group" role="group">
    <button wire:click="$emit('detailProduk', {{ $id }})" data-toggle="modal" data-target="#detailModal"
        class="btn btn-xs btn-info">Detail</button>
    <button wire:click="$emit('editProduk', {{ $id }})" data-toggle="modal" data-target="#produkModal"
        class="btn btn-xs btn-warning">Ubah</button>
    <button wire:click="$emit('deleteId', {{ $id }})" data-toggle="modal" data-target="#deleteModal"
        class="btn btn-xs btn-danger">Hapus</button>
</div>
