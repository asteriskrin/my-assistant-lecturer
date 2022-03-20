{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Test')
@section('content')
    <p>Hello world, passing variable $lowongan.</p>
    <p>{{ $lowongan->getDeskripsi() }}</p>
@endsection
