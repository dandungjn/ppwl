@props([
    'cancel',
    'text' => 'Simpan',
    'submitLabel' => 'Simpan',
])
<div class="d-flex gap-2 justify-content-end mt-4">
    <a href="{{ $cancel }}" class="btn btn-secondary">
        <i class="mdi mdi-close"></i> Batal
    </a>

    <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
        <i class="mdi mdi-content-save"></i> {{ $submitLabel ?? $text }}
    </button>
</div>
