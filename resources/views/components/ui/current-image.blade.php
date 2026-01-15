@props(['src' => null, 'alt' => 'Image', 'width' => 160, 'height' => 120])

@if($src)
    @php
        $url = (filter_var($src, FILTER_VALIDATE_URL)) ? $src : asset('storage/' . ltrim($src, '/'));
    @endphp
    <div class="mb-3">
        <label class="form-label">Current Image</label>
        <div>
            <a href="{{ $url }}" target="_blank" rel="noopener">
                <img src="{{ $url }}" alt="{{ $alt }}" style="max-width:{{ $width }}px; max-height:{{ $height }}px; object-fit:cover; border-radius:6px; border:1px solid #e2e2e8;" />
            </a>
        </div>
    </div>
@endif
