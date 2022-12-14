@extends('layouts.app')
@section('content')
    @include('pesan.message')
    <div class="container text-center my-4">
        <h2>Data Departemen</h2>
    </div>
    <div class="py-2">
        @if (Auth::check())
        @if (Auth::user()->level=='Admin')
        <a href="{{route('departemen.create')}}" class="btn btn-outline-warning">Tambah Data Departemen</a>
        @endif
        <a href="{{route('departemen.create_pdf')}}" class="btn btn-outline-danger">PDF</a>
        <a href="{{route('departemen.export_excel')}}" class="btn btn-outline-success">Excel</a>
        @if (Auth::user()->level=='Admin')
        <a href="{{route('departemen.trash')}}" class="btn btn-outline-secondary">Tong Sampah</a>
        @endif
        @endif
    </div>
    @if (count($departemens) > 0)
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                @if (Auth::check() && Auth::user()->level=='Admin')
                <th scope="col">Ubah</th>
                <th scope="col">Hapus</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($departemens as $departemen)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$departemen->nama}}</td>
                    @if (Auth::check() && Auth::user()->level=='Admin')
                    <td>
                        <a href="{{route('departemen.edit', $departemen->id)}}" class="btn btn-warning">Ubah</a>
                    </td>
                    <td>
                        <form action="{{ route('departemen.destroy', $departemen->id) }}" method="post">
                            @csrf
                            <button class="btn btn-danger" 
                            onclick="return confirm('Anda yakin ingin menghapus data ini ke tong sampah?')">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="text-center text-secondary">
        <h2>- Kosong -</h2>
    </div>
    @endif
@endsection