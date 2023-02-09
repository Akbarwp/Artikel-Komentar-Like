<?php

namespace App\Http\Livewire\Artikel;

use App\Models\Like;
use App\Models\Artikel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Komentar as KomentarModel;

class Komentar extends Component
{
    public $body, $body2, $artikel;
    public $komentar_id, $edit_komentar_id;

    public function mount($id)
    {
        $this->artikel = Artikel::find($id);
    }

    public function render()
    {
        return view('livewire.artikel.komentar', [
            'komentar' => KomentarModel::with(['user', 'children'])->
            where('artikel_id', $this->artikel->id)->
            whereNull('komentar_id')->get(),
            'total_komentar' => KomentarModel::where('artikel_id', $this->artikel->id)->count(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'body' => 'required',
        ]);

        $komentar = KomentarModel::create([
            'user_id' => Auth::user()->id,
            'artikel_id' => $this->artikel->id,
            'body' => $this->body,
        ]);

        if ($komentar) {
            // Cara 1:
            // session()->flash('success', 'Komentar berhasil ditambahkan!');
            // return redirect()->route('artikel.show', $this->artikel->slug);

            // Cara 2:
            $this->emit('komentar_store', $komentar->id);
            $this->body = null;

        } else {
            session()->flash('fail', 'Komentar gagal ditambahkan!');
            return redirect()->route('artikel.show', $this->artikel->slug);
        }
    }

    function edit($id)
    {
        $komentar = KomentarModel::find($id);
        $this->edit_komentar_id = $komentar->id;
        $this->body2 = $komentar->body;
        $this->komentar_id = null;
    }

    public function update()
    {
        $this->validate([
            'body2' => 'required',
        ]);

        $komentar = KomentarModel::where('id', $this->edit_komentar_id)->update([
            'body' => $this->body2,
        ]);

        if ($komentar) {
            $this->emit('komentar_store', $this->edit_komentar_id);
            $this->body2 = null;
            $this->edit_komentar_id = null;

        } else {
            session()->flash('fail', 'Komentar gagal diubah!');
            return redirect()->route('artikel.show', $this->artikel->slug);
        }
    }

    public function delete($id)
    {
        $komentar = KomentarModel::where('id', $id)->delete();

        if ($komentar) {
            // $this->emit('render');
            return null;

        } else {
            session()->flash('fail', 'Komentar gagal dihapus!');
            return redirect()->route('artikel.show', $this->artikel->slug);
        }
    }

    public function showReplay($id)
    {
        $this->komentar_id = $id;
        $this->edit_komentar_id = null;
        $this->body2 = null;
    }

    public function replay()
    {
        $this->validate([
            'body2' => 'required',
        ]);

        $komentar = KomentarModel::find($this->komentar_id);

        $komentar = KomentarModel::create([
            'user_id' => Auth::user()->id,
            'artikel_id' => $this->artikel->id,
            'body' => $this->body2,
            'komentar_id' => $komentar->komentar_id ? $komentar->komentar_id : $komentar->id,
        ]);

        if ($komentar) {
            $this->emit('komentar_store', $komentar->id);
            $this->komentar_id = null;
            $this->body2 = null;

        } else {
            session()->flash('fail', 'Komentar gagal ditambahkan!');
            return redirect()->route('artikel.show', $this->artikel->slug);
        }
    }

    public function like($id)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'komentar_id' => $id,
        ];

        $like = Like::where($data);
        if ($like->count() > 0) {
            $like->delete();

        } else {
            Like::create($data);
        }

        return null;
    }
}
