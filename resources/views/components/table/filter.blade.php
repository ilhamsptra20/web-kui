<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    <div class="row g-2">
        {{ $slot }}

        <div class="col-md-4 d-flex gap-2">
            <button id="apply-filters" class="btn btn-primary">
                <i class="ri-filter-fill align-middle me-1"></i> Apply
            </button>
            <button id="reset-filters" class="btn btn-secondary">
                <i class="ri-refresh-line align-middle me-1"></i> Reset
            </button>
        </div>
    </div>
</div>