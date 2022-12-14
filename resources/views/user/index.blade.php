@extends('layouts.app')
@section('content')
    @include('pesan.message')
    <div class="container text-center my-4">
        <h2>Data User</h2>
    </div>
    <div class="py-2">
        <a href="{{route('user.create_pdf')}}" class="btn btn-outline-danger">PDF</a>
        <a href="{{route('user.export_excel')}}" class="btn btn-outline-success">Excel</a>
        <a href="{{route('user.trash')}}" class="btn btn-outline-secondary">Tong Sampah</a>
    </div>
    @if (count($users) > 0)
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Level</th>
                <th scope="col">Ubah</th>
                <th scope="col">Hapus</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($users as $user)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->level}}</td>
                    <td>
                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-warning">Ubah</a>
                    </td>
                    <td>
                        <form action="{{ route('user.destroy', $user->id) }}" method="post">
                            @csrf
                            <button class="btn btn-danger" 
                            onclick="return confirm('Anda yakin ingin menghapus data ini ke tong sampah?')">Hapus</button>
                        </form>
                    </td>
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