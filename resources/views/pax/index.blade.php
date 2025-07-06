@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->
    <a href="{{ route('pax.create') }}" class="btn btn-primary mb-3">New PAX</a>

    <form action="{{ route('pax.index') }}" method="GET" class="form-inline mb-3">
        <label for="tanggal" class="mr-2">Filter Tanggal Issued:</label>
        <input type="date" format="d-m-Y" name="tanggal" id="tanggal" class="form-control mr-2" value="{{ request('tanggal') }}">

        <input type="text" name="q" class="form-control mr-2" placeholder="Cari Booking/Origin" value="{{ request('q') }}">
        <input type="text" name="miles" class="form-control mr-2" placeholder="MILES" value="{{ request('miles') }}">

        <button type="submit" class="btn btn-secondary mr-2">Filter</button>
        <a href="{{ route('pax.index') }}" class="btn btn-light mr-2">Reset</a>
        <a href="{{ route('pax.export_excel', ['tanggal' => request('tanggal'), 'q' => request('q'), 'miles' => request('miles')]) }}" class="btn btn-success">
            Export to Excel
        </a>    
    </form>




    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- Total Data --}}
    <p>Total Data: {{ $paxs->total() }}</p>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>KODE BOOKING</th>
                <th>DOI</th>
                <th>BERANGKAT</th>
                <th>MONTH</th>
                <th>PIER TO DEPT</th>
                <th>ORIGIN</th>
                <th>ARRIVAL</th>
                <th>PAX</th>
                <th>SUB CLASS</th>
                <th>GA MILES</th>
                <th>TYPE OF TRIP</th>
                <th>CODE CORP</th>
                <th>POI</th>
                <th>EMAIL</th>
                <th>NOMOR</th>
                <th>RESPON PNR</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($paxs as $pax)
            <tr>
                <td>{{ ($paxs->currentPage() - 1) * $paxs->perPage() + $loop->iteration }}</td>
                <td>{{ $pax->kode_booking }}</td>
                <td>{{ $pax->tanggal_issued }}</td>
                <td>{{ $pax->tanggal_berangkat }}</td>
                <td>{{ \Carbon\Carbon::parse($pax->tanggal_issued)->format('m') }}</td>
                <td>{{ \Carbon\Carbon::parse($pax->tanggal_issued)->diffInDays(\Carbon\Carbon::parse($pax->tanggal_berangkat)) }}</td>
                <td>{{ $pax->origin }}</td>
                <td>{{ $pax->arrival }}</td>
                <td>{{ $pax->pax }}</td>
                <td>{{ $pax->sub_class }}</td>
                <td>{{ $pax->ga_miles }}</td>
                <td>{{ $pax->type_of_trip }}</td>
                <td>{{ $pax->code_corp }}</td>
                <td>{{ $pax->poi }}</td>
                <td>{{ $pax->email }}</td>
                <td>{{ $pax->nomor }}</td>
                <td>
                    <form action="{{ route('pax.update_respon_pnr', $pax->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="respon_pnr" onchange="this.form.submit()" class="form-control form-control-sm">
                            <option value="CONFORM" {{ $pax->respon_pnr == 'CONFORM' ? 'selected' : '' }}>CONFORM</option>
                            <option value="CHECKIN" {{ $pax->respon_pnr == 'CHECKIN' ? 'selected' : '' }}>CHECKIN</option>
                            <option value="UNABLE" {{ $pax->respon_pnr == 'UNABLE' ? 'selected' : '' }}>UNABLE</option>
                        </select>
                    </form>
                </td>
                @if (auth()->user()->jenis == 0)
                <td>
                    <div class="d-flex">
                        <a href="{{ route('pax.edit', $pax->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                        <form action="{{ route('pax.destroy', $pax->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Delete</button>
                        </form>
                    </div>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="17" class="text-center">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $paxs->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>



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
