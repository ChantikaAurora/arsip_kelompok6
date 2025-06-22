<?php

// namespace App\Livewire;

// use Livewire\Component;
// use App\Models\Jurusan;
// use App\Models\Prodi;

// class DropdownJurusanProdi extends Component
// {
//     public $jurusan_id = null;
//     public $prodi_id = null;
//     public $prodis;

//     public function mount()
//     {
//         $this->prodis = collect(); // kosong saat awal
//     }

//     public function updatedJurusanId($value)
//     {
//         $this->prodis = Prodi::where('jurusan_id', $value)->get();
//     }

//     public function render()
//     {
//         return view('livewire.dropdown-jurusan-prodi', [
//             'jurusans' => Jurusan::all(),
//         ]);
//     }
// }
