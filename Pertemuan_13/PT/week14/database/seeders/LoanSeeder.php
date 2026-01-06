<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $items = Item::where('stock', '>', 0)->get();

        if ($users->isEmpty() || $items->isEmpty()) {
            return;
        }

        // Setiap user meminjam 1 barang acak
        foreach ($users as $user) {
            $item = $items->random();
            
            Loan::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'status' => 'borrowed',
                'return_date' => null,
            ]);

            // Opsional: Kurangi stok barang karena dipinjam
            $item->decrement('stock');
        }
    }
}
