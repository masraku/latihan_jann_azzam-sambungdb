<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard UTAAMA ADMIN</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Halo, {{ auth()->user()->name }} ({{ auth()->user()->role->nama_role }})</p>

    <h2>Daftar User</h2>
    <table border="1" cellpadding="6">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role?->nama_role ?? '-' }}</td>
            </tr>
        @endforeach
    </table>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
