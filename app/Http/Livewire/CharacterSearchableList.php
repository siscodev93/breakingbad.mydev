<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Character;

class CharacterSearchableList extends Component
{
    public $name = "";
    public $series = "";
    public $status = "";

    public $characters;

    public function search(){
        $data = Character::whereRaw("
            characters.name ilike '%{$this->name}%' and
            characters.category ilike '%{$this->series}%' and
            characters.status ilike '%{$this->status}%'")
        ->get();


        $this->characters = $data;

        return $data;
    }
    public function render()
    {
        $this->characters = $this->search();
        return view('livewire.character-searchable-list');
    }
}
