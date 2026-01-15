@props([
    'name',
    'label' => null,
    'value' => '',
    'rows' => 6,
    'height' => 220,
    'id' => null,
])

@php
    $id = $id ?? $name;
@endphp

<div class="row mb-3 align-items-start">
    @if($label)
        <label class="col-sm-2 col-form-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    <div class="{{ $label ? 'col-sm-10' : 'col-12' }}">
        <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" class="form-control">{{ old($name, $value) }}</textarea>
        @error($name) <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

@once
    @push('scripts')
        {{-- Load TinyMCE from unpkg (no Tiny Cloud API key required) --}}
        <script src="https://unpkg.com/tinymce@6/tinymce.min.js"></script>
        <script>
        (function () {
            function initTiny(selector, height) {
                if (!window.tinymce) return;

                // init only if not already initialized
                if (tinymce.get(selector.replace('#',''))) {
                    return;
                }

                tinymce.init({
                    selector: selector,
                    height: height ?? 220,
                    menubar: false,
                    plugins: 'lists link image table code paste help',
                    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
                    paste_as_text: true,
                    content_style: "body { font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; font-size:14px }",
                    // make sure plugin URLs load from same origin as script
                    base_url: 'https://unpkg.com/tinymce@6',
                });
            }

            // initialize editors on DOMContentLoaded and on-demand
            document.addEventListener('DOMContentLoaded', function () {
                // init all textareas with tinymce component
                document.querySelectorAll('textarea[id]').forEach(function (ta) {
                    // only init those that are intended (we will use data-tinymce attr optionally)
                    // if already initialized skip
                    if (ta.closest('.tinymce-init-processed')) return;
                });

                // init by explicit attribute to avoid initializing every textarea
                document.querySelectorAll('textarea[data-tinymce="1"]').forEach(function (ta) {
                    ta.closest('div').classList.add('tinymce-init-processed');
                    initTiny('#' + ta.id, parseInt(ta.getAttribute('data-height')) || undefined);
                });
            });

            // ensure tinymce content is saved back to textarea before any form submit
            document.addEventListener('submit', function (e) {
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }
            }, true);

            // expose init function for manual init calls
            window.__initTiny = initTiny;
        })();
        </script>
    @endpush
@endonce