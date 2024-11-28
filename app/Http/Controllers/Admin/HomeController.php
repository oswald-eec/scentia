<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        $data = [
            'courses_draft' => Course::where('status', Course::BORRADOR)->count(),
            'courses_revision' => Course::where('status', Course::REVISION)->count(),
            'courses_published' => Course::where('status', Course::PUBLICADO)->count(),
            // 'students_count' => User::role('student')->count(),
            'instructors_count' => User::role('instructor')->count(),
            'admins_count' => User::role('admin')->count(),
            ];

        $courses  = Course::where('status',2)->paginate(8);

        $users = User::with('courses_enrolled')->paginate(10);

        return view('admin.index', compact('data', 'courses', 'users'));

    }
}
