@extends('layouts.app')

@section('main')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $judul }}</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Data
                    </button>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Nama Kategori</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>

                                <th>total stok</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $buku)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $buku->judul }}</th>
                                    <th>{{ $buku->kategori->name }}</th>
                                    <th>{{ $buku->penulis }}</th>
                                    <th>{{ $buku->penerbit }}</th>
                                    <th>{{ $buku->stok }}</th>
                                    <th>
                                        <form action="{{ route('databuku.destroy', $buku->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm ('apakah data akan di hapus?')"><i
                                                    class="fa fa-trash"></i></a></button>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#exampleModaledit{{ $buku->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Modal Create --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('databuku.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="judul">Judul</label>
                                            <input type="text" class="form-control" name="judul" id="judul"
                                                placeholder="Masukan Judul" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select class="form-control" id="kategori" class="form-control"
                                                id="kategori_id" name="kategori_id" required>
                                                @foreach ($dkategori as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="penulis">Penulis</label>
                                            <input type="text" class="form-control" name="penulis" id="penulis"
                                                placeholder="Masukan penulis" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="penerbit">Penerbit</label>
                                            <input type="text" class="form-control" name="penerbit" id="penerbit"
                                                placeholder="Masukan penerbit" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <input type="text" class="form-control" name="deskripsi" id="deskripsi"
                                                placeholder="Masukan deskripsi" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" name="stok" id="stok"
                                                placeholder="Masukan stok" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Edit --}}
                    @foreach ($data as $buku)
                        <div class="modal fade" id="exampleModaledit{{ $buku->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('databuku.update', $buku) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" value="{{ $buku->id }}" name="buku_id">
                                            <div class="form-group">
                                                <label for="judul">Judul</label>
                                                <input type="text" class="form-control" name="judul" id="judul"
                                                    placeholder="Masukan Judul" required value=" {{ $buku->judul }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select class="form-control" id="kategori" class="form-control"
                                                    id="kategori_id" name="kategori_id" required>
                                                    @foreach ($dkategori as $kategori)
                                                        @if ($kategori->id == $buku->kategori_id)
                                                            <option value="{{ $kategori->id }}" selected>
                                                                {{ $kategori->name }}</option>
                                                        @else
                                                            <option value="{{ $kategori->id }}">{{ $kategori->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="penulis">Penulis</label>
                                                <input type="text" class="form-control" name="penulis" id="penulis"
                                                    placeholder="Masukan penulis" required value="{{ $buku->penulis }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="penerbit">Penerbit</label>
                                                <input type="text" class="form-control" name="penerbit"
                                                    id="penerbit" placeholder="Masukan penerbit" required
                                                    value="{{ $buku->penerbit }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi</label>
                                                <input type="text" class="form-control" name="deskripsi"
                                                    id="deskripsi" placeholder="Masukan deskripsi" required
                                                    value="{{ $buku->deskripsi }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="stok">Stok</label>
                                                <input type="number" class="form-control" name="stok" id="stok"
                                                    placeholder="Masukan stok" required value="{{ $buku->stok }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
@endsection
