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
    <table class="table table-striped mt-3">
        <thead class="table">
            <tr>
                <h3 scope="col">Belum Dibaca</h3>
            </tr>
        </thead>
    </table>

    <table class="table belum-dibaca">
    <tbody>
        @foreach($daftar_notifikasi as $dn)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $dn->pesan }}</td>
            </tr>
        @endforeach
    </tbody>

        <!-- <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quas sapiente porro sunt consectetur doloremque alias, maxime eum cupiditate excepturi tempora ut, dolore ipsam mollitia?
                    <div class="current_date"></div>
                </td>
                <td>dimengerti</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis deserunt aut similique corporis nam. Quibusdam debitis soluta fugit animi, magnam est beatae tempore iusto, eum non repellendus vero hic dicta!
                    <div class="current_date"></div>
                </td>
                <td>dimengerti</td>
            <tr>
                <th scope="row">3</th>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil commodi quam nesciunt ea maxime sint consequatur fuga omnis, labore rerum illo fugit ex ab quae provident minus eveniet vel, maiores alias voluptas est reprehenderit. Suscipit tempore incidunt porro maxime minima!
                    <div class="current_date"></div>
                </td>
                <td>dimengerti</td>
            </tr>
        </tbody> -->
    </table>

    <br>
    <table class="table table-striped mt-3">
        <thead class="table">
            <tr>
                <h3 scope="col">Sudah Dibaca</h3>
            </tr>
        </thead>
    </table>

    <table class="table sudah-dibaca">
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quas sapiente porro sunt consectetur doloremque alias, maxime eum cupiditate excepturi tempora ut, dolore ipsam mollitia?
                    <div class="current_date"></div>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis deserunt aut similique corporis nam. Quibusdam debitis soluta fugit animi, magnam est beatae tempore iusto, eum non repellendus vero hic dicta!
                <div class="current_date"></div>
                </td>
            <tr>
                <th scope="row">3</th>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil commodi quam nesciunt ea maxime sint consequatur fuga omnis, labore rerum illo fugit ex ab quae provident minus eveniet vel, maiores alias voluptas est reprehenderit. Suscipit tempore incidunt porro maxime minima!
                <div class="current_date"></div>
                </td>
            </tr>
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
