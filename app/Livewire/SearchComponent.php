<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
// app/Http/Livewire/SearchComponent.php
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = mb_strtolower(trim($this->search), 'UTF-8');

        $roomsQuery = Room::query()
            ->with(['category', 'image'])
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->whereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"])
                        ->orWhereHas('category', function ($subQ) use ($searchTerm) {
                            $subQ->whereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"]);
                        });
                });
            });
        return view('livewire.search-component', [
            'rooms' => $roomsQuery->paginate(9),
        ]);
    }
}
