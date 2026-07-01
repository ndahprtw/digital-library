@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
            <h4 class="fw-semibold mb-8">Pinjam</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted " href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Pinjam</li>
                </ol>
            </nav>
            </div>
            <div class="col-3">
            <div class="text-center mb-n5">  
                <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
            </div>
            </div>
        </div>
        </div>
    </div>
    <section class="datatables">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if(session('success'))
                            <p class="text-success">
                                {{ session('success') }}
                            </p>
                        @elseif(session('error'))
                            <p class="text-danger">
                                {{ session('error') }}
                            </p>
                        @endif

                        <div class="d-flex justify-content-between align-items-center my-3">
                            <form action="{{ route('kategori.index') }}" method="GET" class="d-flex">
                                <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kategori">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-primary mx-3">Refresh</a>
                            </form>

                            @can('view categories')
                                <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Data</a>
                            @endcan
                        </div>

                        <div class="table-responsive">

                            <table class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Peminjam</th>
                                        <th>Buku</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $no => $item)
                                        <tr>
                                            <td> {{ $no+1 }} </td>
                                            <td> {{ $item->tanggal_peminjaman }} </td>
                                            <td> {{ $item->tanggal_pengembalian }} </td>
                                            <td> {{ $item->user->name }} </td>
                                            <td> {{ $item->buku->judul }} </td>
                                            <td> {{ $item->status }} </td>
                                            <td>
                                                @can('return books')
                                                    @if ($item->status == 'dipinjam')
                                                        <form action="{{ route('pinjam.update', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="book_id" value="{{ $item->buku->id }}">
                                                            <button class="btn btn-success" type="submit">Terima</button>
                                                        </form>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <p class="text-danger">
                                            Data belum tersedia.
                                        </p>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-3">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection