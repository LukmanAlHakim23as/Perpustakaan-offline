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
    @if(session('success'))
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
                                <th>Nama Kategori</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kategori)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $kategori->name }}</th>
                                    <th>
                                        <form action="{{ route('datakategori.destroy', $kategori->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm ('apakah data akan di hapus?')"><i
                                                    class="fa fa-trash"></i></a></button>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#exampleModaledit{{ $kategori->id }}">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('datakategori.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Nama Kategori</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Masukan kategori" required>
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
                    @foreach ($data as $kategori)
                        <div class="modal fade" id="exampleModaledit{{ $kategori->id }}" tabindex="-1" role="dialog"
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
                                        <form action="{{ route('datakategori.update', $kategori) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="name">Nama Kategori</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Masukan kategori" value="{{ $kategori->name }}">
                                            </div>
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
                    @endforeach
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
@endsection

<script>
    // Inisialisasi modal Bootstrap
    $(document).ready(function() {
        // Ganti 'editModal' dengan ID modal Anda
        $('#editModal{{ $kategori->id }}').modal('show');
    });
</script>
