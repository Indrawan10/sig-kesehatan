@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- Tailwind CSS -->


    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="text-center">
                <img alt="Logo of Banyumas Regency with a mountain, river, and other elements"
                     class="mx-auto mt-6 mb-6"
                     height="150"
                     src="https://losari.brebeskab.go.id/wp-content/uploads/2020/08/logo-pemkab.png"
                     width="150"/>

                <h1 class="text-2xl font-semibold text-gray-700 mb-4 mt-8">
                    SISTEM INFORMASI GEOGRAFIS
                </h1>
                <h2 class="text-xl font-medium text-gray-600 mb-6">
                   FASILITAS KESEHATAN KECAMATAN LOSARI
                </h2>
                <button class="btn btn-sm btn-primary text-white px-4 py-2 rounded" onclick="window.location.href='/'">
    Lihat Web
</button>

            </div>
        </section>
    </div>
@endsection

@push('scripts')

    <!-- JS Libraries -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>

@endpush
