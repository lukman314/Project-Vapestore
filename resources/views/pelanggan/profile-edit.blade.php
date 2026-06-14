@extends('layouts.pelanggan')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-4">
                <form action="{{ route('pelanggan.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone ?? '' }}">
                    </div>

                    <hr class="my-4">
                    <h6 class="fw-bold mb-3 text-muted">Ganti Password (Kosongkan jika tidak ingin mengubah)</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-vs px-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection