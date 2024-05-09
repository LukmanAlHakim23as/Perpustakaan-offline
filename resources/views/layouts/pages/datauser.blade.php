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
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $user)
                  <tr>
                    <th>{{ $loop->iteration }}</th>
                    <th>{{ $user->name }}</th>
                    <th>{{ $user->email }}</th>
                    <th>{{ $user->role }}</th>
                    <th>
                        <form action="{{ route('datauser.destroy',$user) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm ('apakah data akan di hapus?')"><i
                            class="fa fa-trash"></i></a></button>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModaledit{{ $user->id }}">
                                <i class="fas fa-edit"></i>
                              </button>
                        </form>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('datauser.store') }}" method="post">
          @csrf
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Masukan nama" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Masukan password" required>
            </div>
            <div class="form-group">
              <label for="role">Role</label>
              <select class="form-control" name="role" id="role" required>
                <option>member</option>
                <option>pustakawan</option>
                <option>admin</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="exampleModaledit{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('datauser.update',$user) }}" method="post">
          @csrf
          @method('PATCH')
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Masukan kategori" value="{{ $user->name }}">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" required value="{{ $user->email }}">
            </div>
            <div class="form-group">
              <label for="role">Role</label>
              <select class="form-control" name="role" id="role" required value="{{ $user->role }}">
                  @if ($user->role == 'member')
                  <option value="member" selected>Member</option>
                  <option value="pustakawan">Pustakawan</option>
                  <option value="admin">Admin</option>
              @elseif($user->role == 'pustakawan')
                  <option value="pustakawan" selected>Pustakawan</option>
                  <option value="member">Member</option>
                  <option value="admin">Admin</option>
              @elseif($user->role == 'admin')
                  <option value="admin" selected>Admin</option>
                  <option value="member">Member</option>
                  <option value="pustakawan">Pustakawan</option>
              @endif
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
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
  <!-- /.row -->
@endsection

