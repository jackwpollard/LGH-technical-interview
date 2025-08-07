<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OnRent;
use Illuminate\Support\Facades\DB;

class Report extends Component
{
    private $data;

    public function mount()
    {
        $this->data = OnRent::where('generated_at', '>=', now()->subWeeks(3))
            ->orderBy('generated_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.report', [
            'data' => $this->data
        ]);
    }
}
