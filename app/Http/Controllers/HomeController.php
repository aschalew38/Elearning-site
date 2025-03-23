<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Blog;
use App\Models\Catagory;
use App\Models\Course;
use App\Models\DigitalSolution;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{

    public function index()
    {

        $courses = Course::where("status", "Active")->OrderBy("created_at", "DESC")->paginate(10);
        $blogs = Blog::OrderBy("created_at", "desc")->paginate(10);
        // $trainers=User::where
        $trainners = Role::with('users')->where("name", Constants::TRAINER_ROLE)->get()[0]->users;

        // dd($trainners);
        $digitalSolutions = DigitalSolution::where("status", "Active")->count();
        // dd($digitalSolutions);
        return view("welcome", compact("courses", "blogs", 'digitalSolutions', 'trainners'));
    }
    public function ds(Request $request, $sector = null)
    {
        // dd($sector);
        $query = DigitalSolution::query();
        $query->when($request->query("search"), function ($q) use ($request) {
            $searchQuery = $request->query("search");
            return $q->where('title', 'like', '%' . $searchQuery . '%')->orWhere('objective', 'like', '%' . $searchQuery . '%')->orWhere('detail', 'like', '%' . $searchQuery . '%')->orWhere('focus_area', 'like', '%' . $searchQuery . '%');
        });
        $query->when($sector, function ($q) use ($sector) {
            return $q->where("sector", 'like', '%' . $sector . '%');
        });

        $digitalsolutions = $query->where('status', 'Active')
            ->orderBy('created_at', 'desc')
            ->get();

        $catagories = DigitalSolution::select("sector")->orderBy('sector')->distinct()->get();
        return view('Front.Pages.ds', compact('digitalsolutions', 'catagories'));
    }
    function search(Request $request)
    {

        $query = DigitalSolution::query();
        $query2 = Blog::query();
        $query3 = Course::query();
        $query4 = Event::query();
        $query->when($request->query("search"), function ($q) use ($request) {
            $searchQuery = $request->query("search");
            return $q->where('title', 'like', '%' . $searchQuery . '%')->orWhere('objective', 'like', '%' . $searchQuery . '%')->orWhere('detail', 'like', '%' . $searchQuery . '%')->orWhere('focus_area', 'like', '%' . $searchQuery . '%');
        });
        $query2->when($request->query("search"), function ($q) use ($request) {
            $searchQuery = $request->query("search");
            return $q->where('title', 'like', '%' . $searchQuery . '%')->orWhere('overview', 'like', '%' . $searchQuery . '%')->orWhere('content', 'like', '%' . $searchQuery . '%');
        });
        $query3->when($request->query("search"), function ($q) use ($request) {
            $searchQuery = $request->query("search");
            return $q->where('name', 'like', '%' . $searchQuery . '%')->orWhere('overview', 'like', '%' . $searchQuery . '%')->orWhere('catagory', 'like', '%' . $searchQuery . '%');
        });
        $query4->when($request->query("search"), function ($q) use ($request) {
            $searchQuery = $request->query("search");
            return $q->where('type', 'like', '%' . $searchQuery . '%')->orWhere('about', 'like', '%' . $searchQuery . '%');
        });
        $digitalsolutions = $query->where('status', 'Active')
            ->orderBy('created_at', 'desc')
            ->get();
        $blogs = $query2->where('status', 'Active')
            ->orderBy('created_at', 'desc')

            ->get();
        $courses = $query3->where('status', 'Active')
            ->orderBy('created_at', 'desc')
            ->get();
        $events=$query4->whereDate("ending_date", ">=", Carbon::now())->get();
        $catagories = DigitalSolution::select("sector")->orderBy('sector')->distinct()->get();


        return view("Front.Pages.searchs",compact('digitalsolutions','catagories','blogs','courses','events'));


    }
    public function show(DigitalSolution $digitalSolution)
    {
        $team = $digitalSolution->team;
        // dd($digitalSolution->gallery);
        $partner_sponsor = $digitalSolution->sponsors();
        $partner_implementor = $digitalSolution->Implementor();
        $partner_lead = $digitalSolution->Lead();
        $gallery = $digitalSolution->gallery;
        $target_groups = $digitalSolution->TargetGroups;
        $coverage_areas = $digitalSolution->GeographicAreas;
        return view(
            'Front.Pages.show_ds',
            compact('digitalSolution', 'gallery', 'team', 'partner_implementor', 'partner_sponsor', 'partner_lead', 'target_groups', 'coverage_areas')
        );
    }
    public function events()
    {
        $events = Event::whereDate("ending_date", ">=", Carbon::now())->get();
        return view("Front.Pages.events", compact('events'));
    }
    public function elearning()
    {

        $courses = Course::where("status", "Active")->OrderBy("created_at", "DESC")->paginate(10);
        // dd($courses);
        return view('Front.Pages.elearning', compact('courses'));
    }
    public function about()
    {
        return view('Front.Pages.about');
    }
    public function blogs()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('Front.Pages.blogs', compact('blogs'));
    }
    function contact()
    {
        return view('Front.Pages.contact');
    }
    function blog_show(Blog $blog)
    {
        return view('Front.Pages.blog', compact('blog'));
    }
}
