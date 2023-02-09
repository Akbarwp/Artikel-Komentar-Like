@extends('layouts.app')

@push('css')
    @livewireStyles()
@endpush
@push('js')
    @livewireScripts()

    <script>
        Livewire.on('komentar_store', komentarID => {
            let scroll = document.getElementById('komentar-' + komentarID);
            scroll.scrollIntoView({behavior: 'smooth'}, true);
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="fs-1 fw-bold mb-3 text-success">{{ $artikel->judul }}</h1>
                <div class="mb-3 fw-bold">
                    <span>{{ $artikel->user->name }}</span>
                    <span class="mx-1 text-danger">⁛</span>
                    <span class="text-secondary">{{ $artikel->created_at->format('d F Y') }}</span>
                </div>

                <p class="text-secondary">{{ $artikel->deskripsi }}</p>
                <p class="text-secondary">{{ $artikel->body }}</p>

                <div>
                    @livewire('artikel.komentar', [
                        'id' => $artikel->id,
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
