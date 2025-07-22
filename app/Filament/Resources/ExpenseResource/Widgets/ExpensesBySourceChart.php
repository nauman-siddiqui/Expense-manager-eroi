<?php

namespace App\Filament\Resources\ExpenseResource\Widgets;

use App\Models\Expense;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon; 
use Illuminate\Support\Facades\DB;

class ExpensesBySourceChart extends ChartWidget
{
     protected static ?string $heading = 'Expenses by Source';
    public ?string $filter = 'this_month';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'this_week' => 'This Week',
            'this_month' => 'This Month',
            'this_year' => 'This Year',
        ];
    }

   protected function getData(): array
    {
        $startDate = match ($this->filter) {
            'today' => Carbon::today(),
            'this_week' => Carbon::now()->startOfWeek(),
            'this_month' => Carbon::now()->startOfMonth(),
            'this_year' => Carbon::now()->startOfYear(),
            default => Carbon::now()->startOfMonth(),
        };

        // Get the base query for the selected date range
        $query = Expense::query()->where('date', '>=', $startDate);

        // Calculate total of all expenses in the period
        $totalExpenses = $query->sum('amount');

        // If there are no expenses, return empty data to avoid division by zero
        if ($totalExpenses == 0) {
            return [
                'datasets' => [['label' => 'Expenses %', 'data' => []]],
                'labels' => [],
            ];
        }

        // Get the sum of expenses grouped by source
        $expensesBySource = $query
            ->groupBy('source')
            ->select('source', DB::raw('SUM(amount) as total'))
            ->pluck('total', 'source');

        // Calculate the percentage for each source
        $percentages = $expensesBySource->map(function ($total) use ($totalExpenses) {
            return round(($total / $totalExpenses) * 100, 2);
        });

        // Prepare the data for the chart
        return [
            'datasets' => [
                [
                    'label' => 'Expenses %',
                    'data' => $percentages->values()->toArray(),
                    'backgroundColor' => [
                        '#900e2aff',
                        '#21577bff',
                        '#a1770cff',
                        '#426565ff',
                        '#3d2d5eff',
                        '#81460aff',
                        '#818791ff',
                    ],
                    'borderColor' => '#18181B',
                ],
            ],
            'labels' => $percentages->keys()->toArray(),
        ];

    }

     protected function getType(): string
    {
        return 'pie';
    }
    protected function getOptions(): RawJs
    {
        return RawJs::from(<<<JS
            {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (context) => context.label + ': ' + context.raw + '%'
                        },
                    },
                },
            }
        JS);
    }
}
