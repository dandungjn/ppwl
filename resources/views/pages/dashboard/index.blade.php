<x-app-layout>
    @section('title', 'Dashboard')

    @section('content')
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-8 mb-4 order-0">
                        @include('components.dashboard.hero-card')
                    </div>
                    <div class="col-lg-4 col-md-4 order-1">
                        @include('components.dashboard.profit-sales-cards')
                    </div>
                    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                        @include('components.dashboard.total-revenue-card')
                    </div>
                    <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                        @include('components.dashboard.payments-profile-cards')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                        @include('components.dashboard.order-statistics-card')
                    </div>
                    <div class="col-md-6 col-lg-4 order-1 mb-4">
                        @include('components.dashboard.expense-overview-card')
                    </div>
                    <div class="col-md-6 col-lg-4 order-2 mb-4">
                        @include('components.dashboard.transactions-card')
                    </div>
                </div>
            </div>
            <div class="content-backdrop fade"></div>
        </div>
    @endsection
</x-app-layout>
