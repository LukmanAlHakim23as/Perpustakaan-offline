@extends('layouts.app')

@section('main')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Laporan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/generatePdf" type="button" class="btn btn-primary btn-flat btn-sm">Laporan Pdf</a>
                                
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Peminjam</th>
                                        <th>Admin</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $peminjaman)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $peminjaman->buku->judul }}</td>
                                            <td>{{ $peminjaman->user->name }}</td>
                                            <td>{{ $peminjaman->admin->name }}</td>
                                            <td>{{ $peminjaman->created_at->format('d M Y') }}</td>
                                            <td>{{ ($peminjaman->tgl_kembali)? $peminjaman->tgl_kembali : '-' }}</td>
                                            <td class="text-center"><span
                                                    class="p-2 badge badge-{{ $peminjaman->history ? 'success' : 'warning' }}">{{ $peminjaman->history ? 'Dikembalikan' : 'Dipinjam' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
