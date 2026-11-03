@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <h1>Profil</h1>

    <table class="info">
        <tr>
            <th>Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>{{ ucfirst($user->role) }}</td>
        </tr>
    </table>

    <h2>Ganti Password</h2>

    <div class="form-box">
        <form action="{{ route('profil.password') }}" method="POST">
            @csrf
            @method('PUT')

            <label for="password_lama">Password Lama</label>
            <input type="password" name="password_lama" id="password_lama">
            @error('password_lama')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password_baru">Password Baru</label>
            <input type="password" name="password_baru" id="password_baru">
            @error('password_baru')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="password_baru_confirmation" id="password_baru_confirmation">

            <button type="submit" class="btn">Ganti Password</button>
        </form>
    </div>
@endsection