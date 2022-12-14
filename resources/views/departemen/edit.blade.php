@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container text-center mb-5">
                <h3>Edit Data Departemen</h3>
            </div>
            <form action="{{route('departemen.update', $departemen->id)}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Departemen</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama Departemen" name="nama" value="{{$departemen->nama}}" required>
                </div>
                <button class="btn btn-danger" type="submit">Simpan</button>
            </form>
        </div>
    </div>
@endsection