@props(['name', 'options' => [], 'selected' => [], 'label' => null, 'columns' => 3])

<div class="mb-3">

    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif

    <div class="row gx-2">

        @foreach ($options as $groupName => $groupPermissions)

            @if (is_iterable($groupPermissions))
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="border rounded p-3 h-100">

                        <h6 class="fw-bold text-capitalize mb-2">{{ $groupName }}</h6>

                        <div class="row">
                            @foreach ($groupPermissions as $perm)
                                @php
                                    $value = $perm->name;
                                    $label = ucfirst(explode('.', $perm->name)[1]);
                                @endphp

                                <div class="col-md-{{ 12 / $columns }}">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="{{ $name }}[]" value="{{ $value }}"
                                            id="{{ $name }}_{{ $value }}"
                                            @checked(in_array($value, $selected)) />

                                        <label class="form-check-label"
                                            for="{{ $name }}_{{ $value }}">
                                            {{ $label }}
                                        </label>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                    </div>
                </div>
            @endif

        @endforeach

    </div>
</div>
