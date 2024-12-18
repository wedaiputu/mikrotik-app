<!-- resources/views/vouchers/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Generate Voucher</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('vouchers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Voucher</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password Voucher</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi (hari)</label>
                <input type="number" class="form-control" id="durasi" name="durasi" required>
            </div>

            <div class="mb-3">
                <label for="paket_voucher" class="form-label">Paket Voucher</label>
                <input type="text" class="form-control" id="paket_voucher" name="paket_voucher" required>
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo (Image)</label>
                <input type="file" class="form-control" id="logo" name="logo" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Voucher</button>
        </form>
    </div>
@endsection
