@props(['items' => []])

<nav aria-label="breadcrumb">
    <ol class="breadcrumb fs-5">
        @foreach ($items as $label => $url)
            @if ($loop->last || empty($url))
                <li class="breadcrumb-item active fw-bold" aria-current="page">{{ $label }}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $url }}" class="text-muted">{{ $label }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
