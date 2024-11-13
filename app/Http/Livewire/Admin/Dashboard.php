<?php

namespace App\Http\Livewire\Admin;

use App\Models\Produk;
use App\Models\Usaha;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    use LivewireAlert;
    public $produk, $ekraf, $user, $chartDataEkraf, $chartDataProduk;

    public function mount()
    {
        $this->produk = Produk::all()->count();
        $this->ekraf = Usaha::where('isVerified', true)->count();
        $this->user = User::all()->count();
        $this->chartDataEkraf = $this->getMonthlyEkraf();
        $this->chartDataProduk = $this->getMonthlyProduk();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->extends('layouts.app');
    }

    public function getMonthlyEkraf()
    {
        $year = date('Y');
        $monthlyCounts = DB::table('usahas')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('isVerified', true)
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Initialize an array with zero counts for each month (January to December)
        $monthlyData = array_fill(0, 12, 0);

        // Populate monthly data with counts from the query
        foreach ($monthlyCounts as $month => $count) {
            $monthlyData[$month - 1] = $count; // Subtract 1 to match array indexes (0 for Jan, 11 for Dec)
        }
        // Return the 1D array
        $monthlyDataString = '[' . implode(', ', $monthlyData) . ']';
        return $monthlyDataString;
    }

    public function getMonthlyProduk()
    {
        $year = date('Y');
        $monthlyCounts = DB::table('produks')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Initialize an array with zero counts for each month (January to December)
        $monthlyData = array_fill(0, 12, 0);

        // Populate monthly data with counts from the query
        foreach ($monthlyCounts as $month => $count) {
            $monthlyData[$month - 1] = $count; // Subtract 1 to match array indexes (0 for Jan, 11 for Dec)
        }
        // Return the 1D array
        $monthlyDataString = '[' . implode(', ', $monthlyData) . ']';
        return $monthlyDataString;
    }
}
