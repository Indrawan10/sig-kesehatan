<html>

<head>
    <title>
        Data Wisata
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-black opacity-70 shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">
                <img src="https://logos.flamingtext.com/City-Logos/Losari-Logo.png" alt="Logo" class="h-8">
            </a>

            <!-- Menu Toggle Button -->
            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                ☰
            </button>

            <!-- Menu -->
            <div id="menu" class="hidden md:flex space-x-4">
                <a href="/" class="text-white hover:text-blue-500 px-4">Home</a>
                <a href="#" class="text-white hover:text-blue-500 px-4">Data Kesehatan</a>
                <a href="{{ route('login') }}" class="text-white hover:text-blue-500 px-4">Login</a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white p-4">
            <a href="/" class="block text-white hover:text-blue-500 py-2">Home</a>
            <a href="#" class="block text-white hover:text-blue-500 py-2">Data Kesehatan</a>
            <a href="{{ route('login') }}" class="block text-white hover:text-blue-500 py-2">Login</a>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="relative h-64">
        <img alt="Health-themed image with medical symbols and a stethoscope" class="w-full h-full object-cover"
            height="400"
            src="https://storage.googleapis.com/a1aa/image/VKX1gah2uRreqlVM2kzSfAljn3IjFJ5yY5uSfWOMORk.jpg"
            width="1920" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center">
            <h1 class="text-white text-4xl font-bold">
                Data Fasilitas Kesehatan
            </h1>
            <p class="text-white mt-2">
                Halaman ini memuat informasi Tempat Fasilitas Kesehatan di Kecamatan Losari
            </p>
        </div>
    </section>
    <!-- Table Section -->
    <section class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left border-r border-gray-300">
                            No.
                        </th>
                        <th class="py-3 px-6 text-left border-r border-gray-300">
                            Nama Tempat
                        </th>
                        <th class="py-3 px-6 text-left border-r border-gray-300">
                            Alamat
                        </th>
                        <th class="py-3 px-6 text-left border-r border-gray-300">
                            No Hp
                        </th>
                        <th class="py-3 px-6 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($kesehatans as $index => $kesehatan)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left border-r border-gray-300">
                                {{ $index + 1 }}
                            </td>
                            <td class="py-3 px-6 text-left border-r border-gray-300">
                                {{ $kesehatan->nama_tempat }}
                            </td>
                            <td class="py-3 px-6 text-left border-r border-gray-300">
                                {{ $kesehatan->alamat }}
                            </td>
                            <td class="py-3 px-6 text-left border-r border-gray-300">
                                {{ $kesehatan->nomor_hp }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <button onclick="openModal('{{ $kesehatan->id }}')"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Detail dan Lokasi
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200">
                            <td colspan="5" class="py-3 px-6 text-center text-gray-500">
                                Tidak ada data fasilitas kesehatan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
    {{-- Modal --}}
    <div id="detailModal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden transition-opacity duration-300 opacity-0">
        <div
            class="bg-white rounded-lg shadow-lg w-full max-w-4xl overflow-hidden transform transition-transform duration-300 scale-90">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800" id="modalTitle">Detail Fasilitas Kesehatan</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-4" id="modalContent">
                <div class="flex flex-col md:flex-row">
                    <div class="w-full md:w-1/2 p-4">
                        <div class="mb-6">
                            <h3 class="font-semibold text-lg mb-3 text-blue-600 border-b pb-1">Informasi Fasilitas</h3>
                            <div class="space-y-2">
                                <p><strong class="text-gray-700">Nama Tempat:</strong> <span id="detail-nama"
                                        class="ml-1"></span></p>
                                <p><strong class="text-gray-700">Jenis Fasilitas:</strong> <span id="detail-jenis"
                                        class="ml-1 inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs"></span>
                                </p>
                                <p><strong class="text-gray-700">Jam Operasional:</strong> <span id="detail-jam"
                                        class="ml-1"></span></p>
                                <p><strong class="text-gray-700">Alamat:</strong> <span id="detail-alamat"
                                        class="ml-1"></span></p>
                                <p><strong class="text-gray-700">Nomor HP:</strong> <span id="detail-hp"
                                        class="ml-1"></span></p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h3 class="font-semibold text-lg mb-2 text-blue-600 border-b pb-1">Deskripsi</h3>
                            <p id="detail-deskripsi" class="text-gray-600"></p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 p-4">
                        <h3 class="font-semibold text-lg mb-3 text-blue-600 border-b pb-1">Lokasi</h3>
                        <div id="map" class="h-72 rounded-lg shadow-md"></div>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-gray-200 flex justify-end">
                <button onclick="closeModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    {{-- JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        // Data kesehatan dari PHP ke JavaScript
        const kesehatanData = @json($kesehatans);

        // Variabel untuk menyimpan instance peta
        let map;
        let marker;

        // Buka modal dengan id fasilitas kesehatan
        function openModal(id) {
            // Cari data kesehatan berdasarkan id
            const data = kesehatanData.find(item => item.id == id);

            if (!data) {
                alert('Data tidak ditemukan');
                return;
            }

            // Isi data ke dalam modal
            document.getElementById('detail-nama').textContent = data.nama_tempat;
            document.getElementById('detail-jenis').textContent = data.jenis_fasilitas;
            document.getElementById('detail-jam').textContent = data.jam_operasional;
            document.getElementById('detail-alamat').textContent = data.alamat;
            document.getElementById('detail-hp').textContent = data.nomor_hp;
            document.getElementById('detail-deskripsi').textContent = data.deskripsi;

            // Tampilkan modal dengan animasi
            const modal = document.getElementById('detailModal');
            const modalContent = modal.querySelector('.bg-white');

            modal.classList.remove('hidden');

            // Trigger animasi dengan setTimeout untuk memastikan DOM sudah terupdate
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modalContent.classList.add('scale-100');
                modalContent.classList.remove('scale-90');
            }, 10);

            // Inisialisasi peta setelah modal ditampilkan
            setTimeout(() => {
                if (map) {
                    map.remove();
                }

                map = L.map('map').setView([data.latitude, data.longitude], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                const markerIcon = L.icon({
                    iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${data.marker_color}.png`,
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });

                marker = L.marker([data.latitude, data.longitude], {
                        icon: markerIcon
                    })
                    .addTo(map)
                    .bindPopup(data.nama_tempat)
                    .openPopup();
            }, 300);
        }

        // Tutup modal dengan animasi
        function closeModal() {
            const modal = document.getElementById('detailModal');
            const modalContent = modal.querySelector('.bg-white');

            modal.classList.remove('opacity-100');
            modalContent.classList.add('scale-90');
            modalContent.classList.remove('scale-100');

            // Tunggu animasi selesai sebelum menyembunyikan modal
            setTimeout(() => {
                modal.classList.add('hidden');
                if (map) {
                    map.remove();
                    map = null;
                }
            }, 300);
        }
    </script>
</body>

</html>
