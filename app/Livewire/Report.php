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

    public function downloadCSV()
    {
        $this->mount();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="report.csv"',
        ];

        $callback = function() {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Date', 'Contracts', 'Quotes', 'Weekly Value']);

            foreach ($this->data as $row) {
                fputcsv($handle, [
                    $row->formatted_date,
                    $row->total_contracts,
                    $row->total_quotes,
                    number_format($row->weekly_value, 2)
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
