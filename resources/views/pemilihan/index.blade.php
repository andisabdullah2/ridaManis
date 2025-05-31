@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Voting Ketua Osis') }}</h1>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        @foreach ($kandidats as $kandidat)
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100 text-center">
                    @if($kandidat->image)
                        <img src="{{ asset('storage/' . $kandidat->image) }}" class="card-img-top img-fluid" alt="{{ $kandidat->nama }}" style="height: 250px; object-fit: cover;">
                    @else
                        <img src="{{ asset('img/default.jpg') }}" class="card-img-top img-fluid" alt="Default Image" style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title font-weight-bold">{{ $kandidat->nama }}</h4>
                        <p class="card-text text-muted" style="font-size: 14px;">{{ $kandidat->visimisi }}</p>

                        <div class="mt-auto">
                            <form action="{{ route('pemilihan.store') }}" method="post" onsubmit="return confirmPilih('{{ $kandidat->nama }}')">
                                <input type="hidden" name="kandidat_id" value="{{ $kandidat->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @csrf
                                @if(!$pemilihan || !$pemilihan->id)
                                <button type="submit" class="btn btn-primary btn-block mt-3">Pilih Kandidat</button>
                                @endif
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endpush
<script>
    function confirmPilih(namaKandidat) {
        return confirm('Voting Hanya Bisa Dilakukan 1 Kali, Apakah Anda yakin ingin memilih ' + namaKandidat + ' sebagai Ketua Osis?');
    }
</script>
