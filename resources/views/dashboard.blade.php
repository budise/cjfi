@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Selamat datang, {{ Auth::user()->name }}!
                </div>
                <div class="card-body">
                    <p>Anda berhasil login ke sistem.</p>
                    <p>Silakan gunakan menu di sidebar untuk menjelajahi fitur yang tersedia.</p>
                </div>
            </div>
        </div>
    </div>
@stop
