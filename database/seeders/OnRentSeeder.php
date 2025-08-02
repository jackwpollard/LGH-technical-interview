<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Random\RandomException;
use Throwable;

class OnRentSeeder extends Seeder
{
    public function run(): void
    {
        try
        {
            DB::transaction(function ()
            {
                $this->clearTables();
                $this->generatedOnRentData();
            });
        }
        catch (Throwable $throwable)
        {
            $this->command->error($throwable->getMessage());
        }
    }

    /** @throws RandomException */
    private function generatedOnRentData(): void
    {
        $generated = Carbon::now()
            ->subDays(30)
            ->startOfMonth();

        for ($i = 0; $i < 30; $i++)
        {
            $totalQuotes    = random_int(5, 50);
            $totalContracts = random_int(1, 20);
            $weeklyValue    = 0;
            $onRentId       = $this->getOnRentId($generated, $totalQuotes, $totalContracts);

            for ($j = 0; $j < $totalContracts; $j++)
            {
                $orderValue   = $this->generateRandomOrderValue();
                $weeklyValue += $orderValue;

                $this->addOnRentLine($onRentId, $generated, $orderValue);
            }

            $this->setOnRentWeeklyValue($onRentId, $weeklyValue);

            $generated->addDay();
        }
    }

    private function getOnRentId(Carbon $generated, int $contracts, int $quotes): int
    {
        return DB::table('onrent')->insertGetId([
            'generated_at'    => $generated->format('Y-m-d'),
            'total_contracts' => $contracts,
            'total_quotes'    => $quotes,
            'weekly_value'    => 0,
            'created_at'      => $generated,
            'updated_at'      => $generated,
        ]);
    }

    /** @throws RandomException */
    private function addOnRentLine(int $onRentId, Carbon $generated, float $orderValue): void
    {
        DB::table('onrent_lines')->insert([
            'onrent_id'    => $onRentId,
            'account'      => $this->generateRandomAccount(),
            'order_number' => random_int(10000, 99999),
            'rental_start' => $this->generateRandomRentalStart($generated),
            'dispatch_id'  => random_int(1000, 9999),
            'order_value'  => $orderValue,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }

    private function setOnRentWeeklyValue(int $onRentId, float $weeklyValue): void
    {
        DB::table('onrent')
            ->where('id', $onRentId)
            ->update(['weekly_value' => $weeklyValue]);
    }

    private function clearTables(): void
    {
        DB::table('onrent_lines')
            ->delete();

        DB::table('onrent')
            ->delete();
    }

    /** @throws RandomException */
    private function generateRandomOrderValue(): float
    {
        return round(random_int(10000, 500000) / 100, 2);
    }

    /** @throws RandomException */
    private function generateRandomAccount(): string
    {
        $letters = '';

        for ($i = 0; $i < 4; $i++)
        {
            $letters .= chr(random_int(65, 90));
        }

        return $letters . random_int(1, 9);
    }

    /** @throws RandomException */
    private function generateRandomRentalStart(Carbon $generated): string
    {
        return $generated
            ->copy()
            ->subDays(random_int(30, 60))
            ->format('Y-m-d');
    }
}
