@extends('layouts.app')

@section('title', 'New User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        #map {
            height: 300px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Kesehatan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Tambah Data</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">

                    <form action="{{ route('tambah.data.kesehatan') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Data Baru</h4>
                        </div>
                        <div class="card-body">
                            <!-- Input Nama Tempat -->
                            <div class="form-group">
                                <label>Nama Tempat</label>
                                <input type="text" class="form-control @error('nama_tempat') is-invalid @enderror"
                                    name="nama_tempat" value="{{ old('nama_tempat') }}" required>
                                @error('nama_tempat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis Fasilitas</label>
                                <select class="form-control @error('jenis_fasilitas') is-invalid @enderror"
                                    name="jenis_fasilitas" required>
                                    <option value="rumah sakit"
                                        {{ old('jenis_fasilitas') == 'rumah sakit' ? 'selected' : '' }}>Rumah Sakit</option>
                                    <option value="klinik" {{ old('jenis_fasilitas') == 'klinik' ? 'selected' : '' }}>Klinik
                                    </option>
                                    <option value="apotek" {{ old('jenis_fasilitas') == 'apotek' ? 'selected' : '' }}>Apotek
                                    </option>
                                    <option value="puskesmas" {{ old('jenis_fasilitas') == 'puskesmas' ? 'selected' : '' }}>
                                        Puskesmas</option>
                                </select>
                                @error('jenis_fasilitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Jam Operasional -->
                            <div class="form-group">
                                <label>Jam Operasional</label>
                                <input type="text" class="form-control @error('jam_operasional') is-invalid @enderror"
                                    name="jam_operasional" value="{{ old('jam_operasional') }}">
                                @error('jam_operasional')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Deskripsi -->
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Alamat -->
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nomor HP/Telp</label>
                                <input type="tel" class="form-control @error('nomor_hp') is-invalid @enderror"
                                    name="nomor_hp" value="{{ old('nomor_hp') }}" maxlength="13">
                                @error('nomor_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Latitude -->
                            <div class="form-group">
                                <label>Latitude</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                    id="latitude" name="latitude" value="{{ old('latitude') }}" required>
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Longitude -->
                            <div class="form-group">
                                <label>Longitude</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                    id="longitude" name="longitude" value="{{ old('longitude') }}" required>
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Dropdown Marker Color -->
                            <div class="form-group">
                                <label>Marker Color</label>
                                <select id="markerColor" class="form-control @error('marker_color') is-invalid @enderror"
                                    name="marker_color" required>
                                    <option value="red" {{ old('marker_color') == 'red' ? 'selected' : '' }}>Red
                                    </option>
                                    <option value="blue" {{ old('marker_color') == 'blue' ? 'selected' : '' }}>Blue
                                    </option>
                                    <option value="green" {{ old('marker_color') == 'green' ? 'selected' : '' }}>Green
                                    </option>
                                    <option value="orange" {{ old('marker_color') == 'orange' ? 'selected' : '' }}>Orange
                                    </option>
                                </select>
                                @error('marker_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Peta -->
                            <div class="form-group mt-3">
                                <label>Map Location</label>
                                <div id="map"></div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>

        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
        var map = L.map('map').setView([-6.200000, 106.816666], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);


        function getIcon(color) {
            return new L.Icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${color}.png`,
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
        }

        var marker = L.marker([-6.200000, 106.816666], {
            draggable: true,
            icon: getIcon('red')
        }).addTo(map);

        function updateMarker(lat, lng) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 13);
            document.getElementById('latitude').value = lat.toFixed(8);
            document.getElementById('longitude').value = lng.toFixed(8);
        }

        document.getElementById('latitude').addEventListener('input', function() {
            var lat = parseFloat(this.value);
            var lng = parseFloat(document.getElementById('longitude').value);
            if (!isNaN(lat) && !isNaN(lng)) {
                updateMarker(lat, lng);
            }
        });

        document.getElementById('longitude').addEventListener('input', function() {
            var lat = parseFloat(document.getElementById('latitude').value);
            var lng = parseFloat(this.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                updateMarker(lat, lng);
            }
        });

        marker.on('dragend', function(e) {
            var position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat.toFixed(8);
            document.getElementById('longitude').value = position.lng.toFixed(8);
        });

        document.getElementById('markerColor').addEventListener('change', function() {
            var color = this.value;
            marker.setIcon(getIcon(color));
        });
    </script>
@endpush
