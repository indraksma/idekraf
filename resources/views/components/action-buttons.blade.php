<button wire:click="$emit('addProduk', {{ $id }})" data-toggle="modal" data-target="#produkModal"
    class="btn btn-xs btn-success"><i class="fas fa-plus"></i> Produk</button>
<div class="btn-group" role="group">
    <button wire:click="$emit('detailUsaha', {{ $id }})" data-toggle="modal" data-target="#detailModal"
        class="btn btn-xs btn-info">Detail</button>
    <button wire:click="$emit('editUsaha', {{ $id }})" data-toggle="modal" data-target="#ekrafModal"
        class="btn btn-xs btn-warning">Ubah</button>
    <button wire:click="$emit('deleteId', {{ $id }})" data-toggle="modal" data-target="#deleteModal"
        class="btn btn-xs btn-danger">Hapus</button>
</div>
