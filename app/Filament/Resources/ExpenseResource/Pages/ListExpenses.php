<?php

namespace App\Filament\Resources\ExpenseResource\Pages;

use App\Filament\Resources\ExpenseResource;
use App\Filament\Resources\ExpenseResource\Widgets\ExpensesBySourceChart;
use App\Models\Expense;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ListExpenses extends ListRecords
{
    protected static string $resource = ExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // Add the import action
            Actions\Action::make('import')
                ->label('Import Expenses')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('gray')
                ->form([
                    FileUpload::make('attachment')
                        ->label('CSV File')
                        ->required()
                        ->acceptedFileTypes(['text/csv']),
                ])
                ->action(function (array $data) {
                    $filePath = Storage::disk('public')->path($data['attachment']);

                    DB::beginTransaction();
                    try {
                        $handle = fopen($filePath, 'r');
                        fgetcsv($handle); // Skip header row

                        $count = 0;
                        while (($row = fgetcsv($handle)) !== false) {
                            Expense::create([
                                'date' => $row[0],
                                'source' => $row[1],
                                'amount' => $row[2],
                            ]);
                            $count++;
                        }
                        fclose($handle);

                        DB::commit();

                        Notification::make()
                            ->title("Successfully imported {$count} expenses.")
                            ->success()
                            ->send();

                    } catch (\Exception $e) {
                        DB::rollBack();

                        Notification::make()
                            ->title('Error importing expenses.')
                            ->body('Please check your file format and data. Error: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                })
        ];
    }

     protected function getHeaderWidgets(): array
    {
        return [
            ExpensesBySourceChart::class,
        ];
    }
}
