<?php

namespace App\Livewire\Admin;

use App\Models\Doctors;
use App\Models\Products;
use App\Models\Promos;
use App\Models\Services;
use App\Models\Testimonials;
use App\Models\Visitor;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'stats' => [
                'services' => Services::count(),
                'servicesActive' => Services::where('is_active', true)->count(),
                'products' => Products::count(),
                'productsActive' => Products::where('is_active', true)->count(),
                'promos' => Promos::count(),
                'promosOngoing' => Promos::where(fn ($q) => $q->whereNull('end_date')->orWhereDate('end_date', '>=', now()))->count(),
                'doctors' => Doctors::count(),
                'doctorsActive' => Doctors::where('is_active', true)->count(),
                'testimonials' => Testimonials::count(),
                'ratingAvg' => Testimonials::avg('rating'),
                'totalVisitors' => Visitor::count(),
                'todayVisitors' => Visitor::whereDate('visited_date',today())->count(),
                'monthVisitors' => Visitor::whereBetween('visited_date',[now()->startOfMonth(), now()->endOfMonth(),])->count(),
            ],
            'recentTestimonials' => Testimonials::latest()->take(5)->get(),
            'expiringPromos' => Promos::whereNotNull('end_date')
                ->whereDate('end_date', '>=', now())
                ->where('is_active', true)
                ->orderBy('end_date')
                ->take(5)
                ->get(),
        ]);
    }
}