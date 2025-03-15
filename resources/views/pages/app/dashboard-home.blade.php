<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sistem Informasi Geografis Wisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    <!-- Leaflet CSS -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
</head>
<body class="bg-gray-100 text-white">
    <div class="relative">
           <img src="{{ asset('img/kesehatan.jpg') }}"

             alt="Healthcare theme with medical equipment and stethoscope"
             class="w-full h-screen object-cover"
             width="1920" height="1080"/>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <!-- Navbar -->
        <nav class="bg-black opacity-70 shadow-md fixed top-0 left-0 w-full z-50">
            <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                <a href="/" class="text-xl font-bold text-gray-800">
                    <img src="{{ asset('img/Losari-Logo.png') }}" alt="Logo" class="h-8">
                </a>

                <!-- Menu Toggle Button -->
                <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                    ☰
                </button>

                <!-- Menu -->
                <div id="menu" class="hidden md:flex space-x-4">
                    <a href="/" class="text-white hover:text-blue-500 px-4">Home</a>
                    <a href="{{ route('data.tempat.kesehatan') }}" class="text-white hover:text-blue-500 px-4">Data Kesehatan</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-500 px-4">Login</a>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-black p-4">
                <a href="/" class="block text-white hover:text-blue-500 py-2">Home</a>
                <a href="{{ route('data.tempat.kesehatan') }}" class="block text-white hover:text-blue-500 py-2">Data Kesehatan</a>
                <a href="{{ route('login') }}" class="block text-white hover:text-blue-500 py-2">Login</a>
            </div>
        </nav>

        <!-- Content -->
        <div class="absolute inset-0 flex flex-col justify-center items-start p-8 md:p-16 lg:p-24">
            <h1 class="text-sm md:text-base lg:text-lg font-light">SISTEM INFORMASI GEOGRAFIS FASILITAS KESEHATAN</h1>
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mt-2">KECAMATAN LOSARI</h2>
            <p class="text-sm md:text-base lg:text-lg mt-4 max-w-lg">
                Sistem informasi ini merupakan aplikasi pemetaan geografis tempat kesehatan di wilayah Losari. Aplikasi ini memuat informasi dan lokasi dari tempat kesehatan di Losari.
            </p>
            <a href="https://id.wikipedia.org/wiki/Losari,_Brebes" class="mt-6 px-6 py-3 bg-yellow-500 text-black font-semibold rounded hover:bg-yellow-600">
    LIHAT DETAIL
</a>

        </div>
    </div>

    <!-- Map Section -->
    <section class="py-10">
        <div class="container mx-auto px-6 md:px-12 lg:px-16">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-4">Peta Fasilitas Kesehatan di Kecamatan Losari</h2>
            <div id="map" class="w-full h-96 rounded-lg shadow-lg"></div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-8 mt-10">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16">
            <div class="flex flex-wrap justify-between items-center">
                <!-- Logo & About -->
                <div class="max-w-md">
                    <h2 class="text-2xl font-bold">Losari</h2>
                    <p class="mt-2 text-gray-400 text-justify">
                        Kecamatan Losari adalah salah satu kecamatan yang terletak di Kabupaten Brebes, Jawa Tengah, berbatasan langsung dengan Provinsi Jawa Barat.
                    </p>
                </div>

                <!-- Social Media -->
                <div class="mt-4 md:mt-0">
                    <h3 class="text-lg font-semibold text-right">Ikuti Kami</h3>
                    <div class="mt-2 flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-6 pt-4 text-center text-gray-400">
                &copy; 2025 Sistem Informasi Geografis. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Leaflet JS -->


<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([-6.8515333, 108.8667], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        fetch("{{ route('api.kesehatan') }}")
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    var marker = L.marker([item.latitude, item.longitude], {
                        icon: L.icon({
                            iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${item.marker_color}.png`,
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowSize: [41, 41]
                        })
                    }).addTo(map)
                    .bindPopup(`<b>${item.nama_tempat}</b><br>${item.jenis_fasilitas}<br>${item.alamat}`);
                });
            })
            .catch(error => console.error('Error fetching data:', error));

         document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    });
    </script>
</body>
</html>
