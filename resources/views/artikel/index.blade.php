@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="fs-1 fw-bold mb-3 text-success">Semua Artikel</h1>
            @foreach ($artikel as $item)
                <div class="mb-3">
                    <a href="{{ route('artikel.show', $item->slug) }}" class="text-primary fs-5 fw-semibold">
                        {{ $item->judul }}
                    </a>
                    <div class="fw-bold">
                        <span>{{ $item->user->name }}</span>
                        <span class="mx-1 text-danger">⁛</span>
                        <span class="text-secondary">{{ $item->created_at->format('d F Y') }}</span>
                        <span class="mx-1 text-danger">⁛</span>
                        <span class="fw-normal">(<span class="text-primary">{{ $item->totalKomentar() }}</span>) Komentar</span>
                    </div>
                    <p class="text-secondary">
                        {{ $item->deskripsi }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection