@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('basic.create') }}" class="btn btn-primary mb-3">New User</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('basic.index') }}" method="GET" class="form-inline mb-3">
        <input type="text" name="search" class="form-control mr-2" placeholder="Cari nama atau email..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Kelas</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr 
                @if ($user->jenis == 3)
                    class="table-danger"
                @elseif ($user->jenis == 2)
                    class="table-primary"
                @endif
            >
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->kelas }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('basic.edit', $user->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>

                        <form action="{{ route('basic.pemilih', $user->id) }}" method="POST" class="mr-2">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure to set as Pemilih?')">Pemilih</button>
                        </form>

                        <form action="{{ route('basic.kesiswaan', $user->id) }}" method="POST" class="mr-2">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-info" onclick="return confirm('Are you sure to set as Kesiswaan?')">Kesiswaan</button>
                        </form>

                        <form action="{{ route('basic.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $users->appends(request()->query())->links() }}

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
