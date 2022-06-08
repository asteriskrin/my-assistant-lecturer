{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar Notifikasi')
@section('content')

<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <h2>Notifikasi</h2>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-block" role="alert">
            {{ ucfirst(str_replace('_', ' ', session('success'))) . '.' }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('failed'))
        <div class="alert alert-danger alert-dismissible fade show d-block" role="alert">
            {{ ucfirst(str_replace('_', ' ', session('failed'))) . '.' }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <br>

    <table class="table belum-dibaca">
    <tbody>
        @foreach($daftar_notifikasi as $dn)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $dn->pesan }}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>

<script>
    date = new Date();
    x = document.getElementsByClassName("current_date")
    for (let index = 0; index < x.length; index++) {
        x[index].innerHTML = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
        console.log(x[index])
        console.log(index)
    }
</script>



@endsection
