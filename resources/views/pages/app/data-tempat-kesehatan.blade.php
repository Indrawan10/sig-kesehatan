<html>
 <head>
  <title>
   Data Wisata
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
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
   <img alt="Health-themed image with medical symbols and a stethoscope" class="w-full h-full object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/VKX1gah2uRreqlVM2kzSfAljn3IjFJ5yY5uSfWOMORk.jpg" width="1920"/>
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
      <tr class="border-b border-gray-200 hover:bg-gray-100">
       <td class="py-3 px-6 text-left border-r border-gray-300">
        1
       </td>
       <td class="py-3 px-6 text-left border-r border-gray-300">
        RS Bhakti Asih
       </td>
       <td class="py-3 px-6 text-left border-r border-gray-300">
        Jalan Raya Baturaden Timur Km 3.6, Sawah &amp; Hutan, Limpakuwus, Kec. Sumbang, Kabupaten Banyumas
       </td>
       <td class="py-3 px-6 text-left border-r border-gray-300">
        08983387
       </td>
       <td class="py-3 px-6 text-center">
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
         <i class="fas fa-map-marker-alt">
         </i>
         Detail dan Lokasi
        </button>
       </td>
      </tr>
    </section>
 </body>
</html>
