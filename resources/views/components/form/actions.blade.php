@props([
    'cancel',
    'text' => 'Simpan',
    'col' => 10,
])
<div class="row justify-content-end mt-4">
    <div class="col-sm-{{ $col }} d-flex">

        <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
            <i class="mdi mdi-content-save"></i> {{ $text }}
        </button>

        <a href="{{ $cancel }}" class="btn btn-secondary ms-2">
            Batal
        </a>

    </div>
</div>
