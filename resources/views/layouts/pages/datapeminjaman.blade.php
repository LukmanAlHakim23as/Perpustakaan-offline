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
              <th>Judul Buku</th>
              <th>Peminjam</th>
              <th>Admin/Pustakawan</th>
              <th>Tanggal Pinjam</th>
              <th>Status</th>
              <th>aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dpeminjaman as $peminjaman)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peminjaman->buku->judul }}</td>
                <td>{{ $peminjaman->user->name }}</td>
                <td>{{ $peminjaman->admin->name }}</td>
                <td>{{ $peminjaman->created_at->format('d M Y')}}</td>
                <td>{{ isset($peminjaman->tgl_kembali)? 'selesai' : 'dipinjam'}}</td> }}</td>
                <td>
                    <form action="{{ route('datapeminjaman.update', $peminjaman) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">
                        <input type="hidden" name="buku_id" value="{{ $peminjaman->buku->id }}">
                        <button type="submit" class="btn btn-sm btn-success">Balikin Buku</button>
                    </form>
                </td>
            </tr>
                  <th>
                      
                  </th>
                </tr>
            @endforeach
          </tbody>
        </table>
        {{-- Modal Create --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Peminjaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('datapeminjaman.store') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <label for="buku_id">Judul</label>
                <select class="form-select" id="buku_id" name="buku_id"">
                    @foreach ($dbuku as $buku)
                    <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="user_id">Peminjam</label>
                <select class="form-select" id="user_id" name="user_id"">
                    @foreach ($dmember as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                  </select>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection

