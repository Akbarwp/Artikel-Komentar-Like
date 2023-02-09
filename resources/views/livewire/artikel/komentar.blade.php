<div>
    <h3 class="mb-3">(<span class="text-primary">{{ $total_komentar }}</span>) Komentar</h3>
    @auth
        <form wire:submit.prevent="store" class="mb-4">
            <div class="mb-3">
                <textarea wire:model.defer="body" name="body" cols="105" rows="5"
                    class="form-control mb-3 border-1 border-primary border-opacity-25 rounded @error('body') is-invalid @enderror"
                    placeholder="Tulis komentar Anda ....."></textarea>
                @error('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    @endauth

    @guest
        <div class="alert alert-info fs-5" role="alert">
            Silakan <a href="{{ route('login') }}">login</a> untuk dapat berkomentar!
        </div>
    @endguest

    @foreach ($komentar as $item)
        <div class="mb-4" id="komentar-{{ $item->id }}">
            <div class="d-flex align-items-start mb-4">
                <img src="https://source.unsplash.com/100x100?user" alt="avatar_user" width="40"
                    class="img-fluid rounded-circle me-3">
                <div>
                    <div>
                        <span class="fw-semibold me-1">{{ $item->user->name }}</span>
                        <span class="text-secondary fw-semibold">{{ $item->created_at->format('d-M-Y H:i:s') }}</span>
                    </div>
                    <div class="text-secondary mb-2">
                        {{ $item->body }}
                    </div>
                    <div>
                        @auth
                            <button class="btn btn-sm btn-primary"
                                wire:click="showReplay({{ $item->id }})">Balas</button>
                            @if ($item->user_id == Auth::user()->id)
                                <button class="btn btn-sm btn-warning" wire:click="edit({{ $item->id }})">Ubah</button>
                                <button class="btn btn-sm btn-danger"
                                    wire:click="delete({{ $item->id }})">Hapus</button>
                            @endif

                            @if ($item->hasLike)
                                <button class="btn btn-sm btn-danger" wire:click="like({{ $item->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                        height="20">
                                        <path fill="none" d="M0 0H24V24H0z" />
                                        <path
                                            d="M20.243 4.757c2.262 2.268 2.34 5.88.236 8.236l-8.48 8.492-8.478-8.492c-2.104-2.356-2.025-5.974.236-8.236C5.515 3 8.093 2.56 10.261 3.44L6.343 7.358l1.414 1.415L12 4.53l-.013-.014.014.013c2.349-2.109 5.979-2.039 8.242.228z"
                                            fill="rgba(255,255,255,1)" />
                                    </svg>
                                    <span>(<span class="text-warning">{{ $item->totalLike() }}</span>)</span>
                                </button>
                            @else
                                <button class="btn btn-sm btn-dark" wire:click="like({{ $item->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                        height="20">
                                        <path fill="none" d="M0 0H24V24H0z" />
                                        <path
                                            d="M20.243 4.757c2.262 2.268 2.34 5.88.236 8.236l-8.48 8.492-8.478-8.492c-2.104-2.356-2.025-5.974.236-8.236C5.515 3 8.093 2.56 10.261 3.44L6.343 7.358l1.414 1.415L12 4.53l-.013-.014.014.013c2.349-2.109 5.979-2.039 8.242.228z"
                                            fill="rgba(255,255,255,1)" />
                                    </svg>
                                    <span>(<span class="text-warning">{{ $item->totalLike() }}</span>)</span>
                                </button>
                            @endif
                        @endauth
                        @guest
                            <span class="text-bg-danger rounded p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                    <path fill="none" d="M0 0H24V24H0z" />
                                    <path
                                        d="M20.243 4.757c2.262 2.268 2.34 5.88.236 8.236l-8.48 8.492-8.478-8.492c-2.104-2.356-2.025-5.974.236-8.236C5.515 3 8.093 2.56 10.261 3.44L6.343 7.358l1.414 1.415L12 4.53l-.013-.014.014.013c2.349-2.109 5.979-2.039 8.242.228z"
                                        fill="rgba(255,255,255,1)" />
                                </svg>
                                <span>(<span class="text-warning">3</span>)</span>
                            </span>
                        @endguest
                    </div>
                    @if (isset($komentar_id) && $komentar_id == $item->id)
                        <form wire:submit.prevent="replay" class="mt-3">
                            <div class="mb-3">
                                <textarea wire:model.defer="body2" name="body2" cols="105" rows="5"
                                    class="form-control mb-3 border-1 border-primary border-opacity-25 rounded @error('body2') is-invalid @enderror"
                                    placeholder="Tulis komentar Anda ....."></textarea>
                                @error('body2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-secondary">Replay</button>
                            </div>
                        </form>
                    @endif

                    @if (isset($edit_komentar_id) && $edit_komentar_id == $item->id)
                        <form wire:submit.prevent="update" class="mt-3">
                            <div class="mb-3">
                                <textarea wire:model.defer="body2" name="body2" cols="105" rows="5"
                                    class="form-control mb-3 border-1 border-primary border-opacity-25 rounded @error('body2') is-invalid @enderror"
                                    placeholder="Tulis komentar Anda ....."></textarea>
                                @error('body2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning">Ubah</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Awal Children (Reply) --}}
            @if ($item->children)
                @foreach ($item->children as $item2)
                    <div class="d-flex align-items-start ms-4">
                        <img src="https://source.unsplash.com/100x100?user" alt="avatar_user" width="40"
                            class="img-fluid rounded-circle me-3">
                        <div>
                            <div>
                                <span class="fw-semibold me-1">{{ $item2->user->name }}</span>
                                <span
                                    class="text-secondary fw-semibold">{{ $item2->created_at->format('d-M-Y H:i:s') }}</span>
                            </div>
                            <div class="text-secondary mb-2">
                                {{ $item2->body }}
                            </div>

                            <div>
                                @auth
                                    <button class="btn btn-sm btn-primary"
                                        wire:click="showReplay({{ $item2->id }})">Balas</button>
                                    @if ($item2->user_id == Auth::user()->id)
                                        <button class="btn btn-sm btn-warning"
                                            wire:click="edit({{ $item2->id }})">Ubah</button>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click="delete({{ $item2->id }})">Hapus</button>
                                    @endif

                                    @if ($item2->hasLike)
                                        <button class="btn btn-sm btn-danger" wire:click="like({{ $item2->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                                height="20">
                                                <path fill="none" d="M0 0H24V24H0z" />
                                                <path
                                                    d="M20.243 4.757c2.262 2.268 2.34 5.88.236 8.236l-8.48 8.492-8.478-8.492c-2.104-2.356-2.025-5.974.236-8.236C5.515 3 8.093 2.56 10.261 3.44L6.343 7.358l1.414 1.415L12 4.53l-.013-.014.014.013c2.349-2.109 5.979-2.039 8.242.228z"
                                                    fill="rgba(255,255,255,1)" />
                                            </svg>
                                            <span>(<span class="text-warning">{{ $item2->totalLike() }}</span>)</span>
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-dark" wire:click="like({{ $item2->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                                height="20">
                                                <path fill="none" d="M0 0H24V24H0z" />
                                                <path
                                                    d="M20.243 4.757c2.262 2.268 2.34 5.88.236 8.236l-8.48 8.492-8.478-8.492c-2.104-2.356-2.025-5.974.236-8.236C5.515 3 8.093 2.56 10.261 3.44L6.343 7.358l1.414 1.415L12 4.53l-.013-.014.014.013c2.349-2.109 5.979-2.039 8.242.228z"
                                                    fill="rgba(255,255,255,1)" />
                                            </svg>
                                            <span>(<span class="text-warning">{{ $item2->totalLike() }}</span>)</span>
                                        </button>
                                    @endif
                                @endauth

                                @guest
                                    <span class="text-bg-dark rounded p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                            height="20">
                                            <path fill="none" d="M0 0H24V24H0z" />
                                            <path
                                                d="M20.243 4.757c2.262 2.268 2.34 5.88.236 8.236l-8.48 8.492-8.478-8.492c-2.104-2.356-2.025-5.974.236-8.236C5.515 3 8.093 2.56 10.261 3.44L6.343 7.358l1.414 1.415L12 4.53l-.013-.014.014.013c2.349-2.109 5.979-2.039 8.242.228z"
                                                fill="rgba(255,255,255,1)" />
                                        </svg>
                                        <span>(<span class="text-warning">{{ $item->totalLike() }}</span>)</span>
                                    </span>
                                @endguest
                            </div>
                        </div>
                    </div>

                    {{-- Awal Form Komentar --}}
                    @if (isset($komentar_id) && $komentar_id == $item2->id)
                        <form wire:submit.prevent="replay" class="mt-3">
                            <div class="mb-3">
                                <textarea wire:model.defer="body2" name="body2" cols="105" rows="5"
                                    class="form-control mb-3 border-1 border-primary border-opacity-25 rounded @error('body2') is-invalid @enderror"
                                    placeholder="Tulis komentar Anda ....."></textarea>
                                @error('body2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-secondary">Replay</button>
                            </div>
                        </form>
                    @endif

                    @if (isset($edit_komentar_id) && $edit_komentar_id == $item2->id)
                        <form wire:submit.prevent="update" class="mt-3">
                            <div class="mb-3">
                                <textarea wire:model.defer="body2" name="body2" cols="105" rows="5"
                                    class="form-control mb-3 border-1 border-primary border-opacity-25 rounded @error('body2') is-invalid @enderror"
                                    placeholder="Tulis komentar Anda ....."></textarea>
                                @error('body2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning">Ubah</button>
                            </div>
                        </form>
                    @endif
                    {{-- Akhir Form Komentar --}}

                    <hr>
                @endforeach
            @endif
            {{-- Akhir Children (Reply) --}}
        </div>
    @endforeach
</div>
