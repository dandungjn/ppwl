@props([
    'title',
    'breadcrumb' => [],
])

<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex flex-column">
        <h1 class="mb-2 fw-bold">{{ $title }}</h1>
        <x-breadcrumb :items="$breadcrumb" />
    </div>
    <div>
        {{ $slot }}
    </div>
</div>
