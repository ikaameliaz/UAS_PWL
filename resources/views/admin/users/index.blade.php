@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manajemen Pengguna</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Ubah Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role }}</td>
                    <td>
                        <form action="{{ route('admin.user.updateRole', $u->id) }}" method="POST">
                            @csrf
                            <select name="role" onchange="this.form.submit()" class="form-select">
                                <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="editor" {{ $u->role === 'editor' ? 'selected' : '' }}>Editor</option>
                                <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manajemen Pengguna</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Ubah Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role }}</td>
                    <td>
                        <form action="{{ route('admin.user.updateRole', $u->id) }}" method="POST">
                            @csrf
                            <select name="role" onchange="this.form.submit()" class="form-select">
                                <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="editor" {{ $u->role === 'editor' ? 'selected' : '' }}>Editor</option>
                                <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
