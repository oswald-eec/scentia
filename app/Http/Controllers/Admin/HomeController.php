<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // public function index(){

    //     $data = [
    //         'courses_draft' => Course::where('status', Course::BORRADOR)->count(),
    //         'courses_revision' => Course::where('status', Course::REVISION)->count(),
    //         'courses_published' => Course::where('status', Course::PUBLICADO)->count(),
    //         // 'students_count' => User::role('student')->count(),
    //         'instructors_count' => User::role('instructor')->count(),
    //         'admins_count' => User::role('admin')->count(),
    //         ];

    //     $courses  = Course::where('status',2)->paginate(8);

    //     $users = User::with('courses_enrolled')->paginate(10);

    //     return view('admin.index', compact('data', 'courses', 'users'));

    // }
    public function index()
    {
        // Datos generales de cursos y usuarios
        $data = [
            'courses_draft' => Course::where('status', Course::BORRADOR)->count(),
            'courses_revision' => Course::where('status', Course::REVISION)->count(),
            'courses_published' => Course::where('status', Course::PUBLICADO)->count(),
            'instructors_count' => User::role('instructor')->count(),
            'admins_count' => User::role('admin')->count(),
        ];

        // Obtener los cursos más vendidos
        $mostPurchasedCourses = Course::mostPurchased()->take(5)->get();

        // Obtener los cursos más populares
        $mostPopularCourses = Course::popular()->take(5)->get();

        // Obtener los usuarios con más compras
        $topCustomers = User::withCount('courses_enrolled')
            ->orderBy('courses_enrolled_count', 'desc')
            ->take(5)
            ->get();

        // Generar datos para gráficos de ventas
        // $salesData = $this->getSalesData();

        // Pasar los datos a la vista
        return view('admin.index', compact(
            'data',
            'mostPurchasedCourses',
            'mostPopularCourses',
            'topCustomers',
            // 'salesData'
        ));
    }

    /**
     * Obtener datos de ventas por mes y año para gráficos.
     */
    // private function getSalesData()
    // {
    //     // Ventas por mes del año actual
    //     $monthlySales = Course::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    //         ->whereYear('created_at', Carbon::now()->year)
    //         ->groupBy('month')
    //         ->orderBy('month')
    //         ->pluck('total', 'month');

    //     // Ventas por año
    //     $yearlySales = Course::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
    //         ->groupBy('year')
    //         ->orderBy('year')
    //         ->pluck('total', 'year');

    //     return [
    //         'monthlySales' => $monthlySales,
    //         'yearlySales' => $yearlySales,
    //     ];
    // }

}
