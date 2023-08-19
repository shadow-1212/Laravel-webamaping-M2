<?php

namespace App\Http\Livewire\Monuments;

use Livewire\Component;
use App\Models\Monument;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $listeners = ['saved' => 'render'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.monuments.index', [
            'monuments' => Monument::query()
                ->leftJoin('world_administrative_boundaries', DB::raw('st_within(monuments.geom, "world_administrative_boundaries".geom)'), '=', DB::raw('true'))
                ->selectRaw('monuments.name as name, "world_administrative_boundaries".adm3_en as country, st_asgeojson(monuments.*) as geojson')
                ->when($this->search, function ($query, $search) {
                    $search = '%' . $search . '%';
                    $query->where('monuments.name', 'ilike', $search)
                        ->orWhere('world_administrative_boundaries.name', 'ilike', $search);
                })
                ->orderBy('monuments.name')
                ->simplePaginate(10)
        ]);
    }
}
