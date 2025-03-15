@extends('layouts.app')

@section('title', 'Daftar Data Kesehatan')

@push('style')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- Swall alert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        #mapModal {
            height: 400px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Fasilitas Kesehatan</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Fasilitas Kesehatan</h4>
                        <div class="card-header-action">
                            <a href="{{ route('tambah.data.kesehatan') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tempat</th>
                                        <th>Nomor Handphone</th>
                                        <th>Jenis Fasilitas</th>
                                        <th>Jam Operasional</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kesehatans as $kesehatan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kesehatan->nama_tempat }}</td>
                                            <td>{{ $kesehatan->nomor_hp }}</td>
                                            <td>{{ $kesehatan->jenis_fasilitas }}</td>
                                            <td>{{ $kesehatan->jam_operasional }}</td>
                                            <td>{{ $kesehatan->alamat }}</td>
                                            <td>
                                                <div class="btn-group d-flex flex-column" role="group">
                                                    <!-- Tombol Edit -->
                                                    <button type="button" class="btn btn-info btn-sm edit-btn mb-2"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $kesehatan->id }}"
                                                        data-nama_tempat="{{ $kesehatan->nama_tempat }}"
                                                        data-jenis_fasilitas="{{ $kesehatan->jenis_fasilitas }}"
                                                        data-jam_operasional="{{ $kesehatan->jam_operasional }}"
                                                        data-deskripsi="{{ $kesehatan->deskripsi }}"
                                                        data-alamat="{{ $kesehatan->alamat }}"
                                                        data-latitude="{{ $kesehatan->latitude }}"
                                                        data-longitude="{{ $kesehatan->longitude }}"
                                                        data-marker_color="{{ $kesehatan->marker_color }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>

                                                    <!-- Tombol Hapus -->
                                                    <form
                                                        action="{{ route('list.data.kesehatan.destroy', $kesehatan->id) }}"
                                                        method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type= "submit" class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                            <i class="fas fa-times"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Kesehatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Tempat</label>
                                        <input type="text" class="form-control" name="nama_tempat" id="edit_nama_tempat"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Fasilitas</label>
                                        <select class="form-control" name="jenis_fasilitas" id="edit_jenis_fasilitas"
                                            required>
                                            <option value="rumah sakit">Rumah Sakit</option>
                                            <option value="klinik">Klinik</option>
                                            <option value="apotek">Apotek</option>
                                            <option value="puskesmas">Puskesmas</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jam Operasional</label>
                                        <input type="text" class="form-control" name="jam_operasional"
                                            id="edit_jam_operasional" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="edit_alamat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" id="edit_deskripsi" rows="4" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input type="text" class="form-control" name="latitude" id="edit_latitude"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="edit_longitude"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Marker Color</label>
                                <select class="form-control" name="marker_color" id="edit_marker_color" required>
                                    <option value="red">Red</option>
                                    <option value="blue">Blue</option>
                                    <option value="green">Green</option>
                                    <option value="orange">Orange</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- Tambahkan SweetAlert JS sebelum script lainnya -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#dataTable').DataTable();

            // Handler untuk tombol edit
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var nama_tempat = $(this).data('nama_tempat');
                var jenis_fasilitas = $(this).data('jenis_fasilitas');
                var jam_operasional = $(this).data('jam_operasional');
                var deskripsi = $(this).data('deskripsi');
                var alamat = $(this).data('alamat');
                var latitude = $(this).data('latitude');
                var longitude = $(this).data('longitude');
                var marker_color = $(this).data('marker_color');

                // Isi form modal dengan data
                $('#editForm').attr('action', '/list-data-kesehatan/' + id);
                $('#edit_nama_tempat').val(nama_tempat);
                $('#edit_jenis_fasilitas').val(jenis_fasilitas);
                $('#edit_jam_operasional').val(jam_operasional);
                $('#edit_deskripsi').val(deskripsi);
                $('#edit_alamat').val(alamat);
                $('#edit_latitude').val(latitude);
                $('#edit_longitude').val(longitude);
                $('#edit_marker_color').val(marker_color);
            });

            // Konfirmasi Hapus
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Tampilkan pesan sukses
            @if (session('success'))
                Swal.fire({
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
@endpush
