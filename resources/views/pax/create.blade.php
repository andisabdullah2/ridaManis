@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pax.store') }}" method="post">
              @csrf
              <div class="">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="nama">Nama pax</label>
                      <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama pax" autocomplete="off" value="{{ old('nama') }}">
                      @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="kode_booking">Kode Booking</label>
                      <input type="text" class="form-control @error('kode_booking') is-invalid @enderror" name="kode_booking" id="kode_booking" placeholder="Kode Booking" autocomplete="off" value="{{ old('kode_booking') }}">
                      @error('kode_booking')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="flight_number">Flight number</label>
                      <input type="text" class="form-control @error('flight_number') is-invalid @enderror" name="flight_number" id="flight_number" placeholder="Nomor Pesawat" autocomplete="off" value="605">
                      @error('flight_number')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggal_issued">ISSUED</label>
                      <input type="date" class="form-control @error('tanggal_issued') is-invalid @enderror" name="tanggal_issued" id="tanggal_issued" value="{{ old('tanggal_issued') }}">
                      @error('tanggal_issued')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggal_berangkat">BERANGKAT</label>
                      <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror" name="tanggal_berangkat" id="tanggal_berangkat" value="{{ old('tanggal_berangkat', \Carbon\Carbon::tomorrow()->format('Y-m-d')) }}">
                      @error('tanggal_berangkat')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="origin">ORIGIN</label>
                      <input type="text" class="form-control @error('origin') is-invalid @enderror" name="origin" id="origin" value="KDI">
                      @error('origin')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="arrival">ARRIVAL</label>
                      <input type="text" class="form-control @error('arrival') is-invalid @enderror" name="arrival" id="arrival" value="UPG">
                      @error('arrival')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="pax">PAX</label>
                      <input type="text" class="form-control @error('pax') is-invalid @enderror" name="pax" id="pax" value="{{ old('pax') }}">
                      @error('pax')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="sub_class">SUB CLASS</label>
                      <input type="text" class="form-control @error('sub_class') is-invalid @enderror" name="sub_class" id="sub_class" value="Y">
                      @error('sub_class')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ga_miles">GA MILES</label>
                      <input type="text" class="form-control @error('ga_miles') is-invalid @enderror" name="ga_miles" id="ga_miles" value="NO DATA">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="type_of_trip">TYPE OF TRIP</label>
                      <select name="type_of_trip" id="type_of_trip" class="form-control">
                        <option value="ONE WAY">ONE WAY</option>
                        <option value="RETURN">RETURN</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="code_corp">CODE CORP</label>
                      <input type="text" class="form-control @error('code_corp') is-invalid @enderror" name="code_corp" id="code_corp" value="UMUM">
                      @error('code_corp')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="poi">POI</label>
                      <input type="text" class="form-control @error('poi') is-invalid @enderror" name="poi" id="poi" value="TRAVELOKADOTCOM">
                      @error('poi')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nomor">Nomor Hp Pax</label>
                      <input type="text" class="form-control @error('nomor') is-invalid @enderror" name="nomor" id="nomor" value="{{ old('nomor') }}">
                      @error('nomor')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email Pax</label>
                      <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nomor_tiket">Nomor Tiket Pax</label>
                      <input type="text" class="form-control @error('nomor_tiket') is-invalid @enderror" name="nomor_tiket" id="nomor_tiket" value="{{ old('nomor_tiket') }}">
                      @error('nomor_tiket')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="mt-3">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{ route('pax.index') }}" class="btn btn-secondary">Back to list</a>
                </div>
              </div>
          </form>

        </div>
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
