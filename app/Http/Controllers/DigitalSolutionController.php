<?php

namespace App\Http\Controllers;

use App\Models\DigitalSolution;
use App\Models\Gallery;
use App\Models\GeographicArea;
use App\Models\Partner;
use App\Models\Team;
use App\Models\TargetGroup;
use Illuminate\Http\Request;
use App\Constants;
use App\Models\Catagory;
use App\Models\OrganizationType;
use Illuminate\Support\Facades\Auth;

class DigitalSolutionController extends Controller
{

    public function index()
    {

        $digitalSolutions = DigitalSolution::orderBy(
            'created_at',
            'desc'
        )->get();

        $user = auth()->user();
        $digitalSolutions = null;
        if ($user->hasAnyRole([Constants::SUPER_ADMIN_ROLE, Constants::ADMIN_ROLE])) {
            $digitalSolutions = DigitalSolution::orderBy(
                'created_at',
                'desc'
            )->paginate(10);
        } else {
            $digitalSolutions = DigitalSolution::orderBy(
                'created_at',
                'desc'
            )->whereNot("status", "Pending")->get();
            $user_ds = DigitalSolution::where("user_id", auth()->user()->id)->orderBy(
                'created_at',
                'desc'
            )->get();
            $digitalSolutions = $digitalSolutions->merge($user_ds);
        }
        $catagories = Catagory::get();
        // dd($catagories);
        return view('DigitalSolution.index', compact('digitalSolutions'));
    }


    public function create()
    {

        $this->authorize("digitalSolution.create");
        $digitalSolution = null;
        $catagories=Catagory::orderBy("name")->get();
        $office_types=OrganizationType::all();

        return view('DigitalSolution.create', compact('digitalSolution','catagories','office_types'));
    }

    public function activate(DigitalSolution $digitalSolution)
    {

        $this->authorize("digitalSolution.activate");
        $digitalSolution->status = 'Active';
        $digitalSolution->save();
        return redirect()
            ->route('digitalSolution.index')
            ->with('success', 'Successfully Activated');
    }
    public function deactivate(DigitalSolution $digitalSolution)
    {

        $this->authorize("digitalSolution.deactivate");
        $digitalSolution->status = 'Removed';
        $digitalSolution->save();
        return redirect()
            ->route('digitalSolution.index')
            ->with('success', 'Successfully Deactivated');
    }
    public function store(Request $request)
    {

        $this->authorize("digitalSolution.store");
        //
        $data = $request->validate([
            'title' => 'required|string',
            'objective' => 'nullable|string',
            'detail' => 'nullable|string',
            'sector' => 'nullable',
            'focus_area' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        $data['user_id'] = auth()->user()?->id;
        if ($request->hasFile("poster")) {
            $data['poster'] = $request->file('poster')->store('posters');
        }
        $ds = DigitalSolution::firstOrCreate($data);
        if ($ds) {
            //target group
            if ($request['tgroup']) {
                $target_groups = [];
                foreach ($request['tgroup'] as $tgroup) {
                    array_push($target_groups, [
                        'name' => $tgroup['name'],
                        'digital_solution_id' => $ds->id,
                    ]);
                }
                TargetGroup::insert($target_groups);
            }
            if ($request['area']) {

                $geographical_area = [];
                foreach ($request['area'] as $area) {
                    array_push($geographical_area, [
                        'name' => $area['name'],
                        'digital_solution_id' => $ds->id,
                    ]);
                }
                GeographicArea::insert($geographical_area);
            }

            // dd($request->hasFile("gallery"));
            if ($request["gallery"]) {

                $gallery_photos = [];

                // dd();
                foreach ($request->file('gallery') as $gallery) {
                    // dd();
                    $path = $gallery['photo']->store('Galleries');
                    array_push($gallery_photos, [
                        'path' => $path,
                        'digital_solution_id' => $ds->id,
                    ]);
                }
                // dd($gallery_photos);
                Gallery::insert($gallery_photos);
            }


            if ($request['team']) {
                $team_members = [];
                foreach ($request['team'] as $team) {

                    array_push($team_members, [
                        'name' => $team['name'],
                        'email' => $team['email'],
                        'phone' => $team['phone'],
                        'digital_solution_id' => $ds->id,
                    ]);
                }
                Team::insert($team_members);
            }

            if (count($request['part'])>0) {
                $partner = [];
                $i = 0;
                foreach ($request['part'] as $key => $part) {
                    if(!$request->file("part"))
                    continue;
                    $paths = $request->file("part")[$key]['logo']->store("Logos");
                    array_push($partner, [
                        'name' => $part['name'],
                        'email' => $part['email'],
                        'url' => $part['url'],
                        'phone' => $part['phone'],
                        'type' => $part['type'],
                        'logo' => $paths,
                        'digital_solution_id' => $ds->id,
                    ]);
                }
                Partner::insert($partner);
            }
            return redirect()->route("digitalSolution.index")->with("success", "Sucessfully Registered");
        }
    }


    public function show(DigitalSolution $digitalSolution)
    {

        $comments = $digitalSolution->comments->sortByDesc("created_at");
        // dd($comments);
        $team = $digitalSolution->team;
        // dd($digitalSolution->gallery);
        $partner_sponsor = $digitalSolution->sponsors();
        $partner_implementor = $digitalSolution->Implementor();
        $partner_lead = $digitalSolution->Lead();
        $gallery = $digitalSolution->gallery;
        $target_groups = $digitalSolution->TargetGroups;
        $coverage_areas = $digitalSolution->GeographicAreas;
        return view('DigitalSolution.show', compact('digitalSolution', 'comments','gallery', 'team', 'partner_implementor', 'partner_sponsor', 'partner_lead', 'target_groups', 'coverage_areas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DigitalSolution  $digitalSolution
     * @return \Illuminate\Http\Response
     */
    public function edit(DigitalSolution $digitalSolution)
    {

        $catagories=Catagory::orderBy("name")->get();
        $office_types=OrganizationType::all();
        $this->authorize("digitalSolution.edit");
        return view('DigitalSolution.edit', compact('digitalSolution','catagories','office_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DigitalSolution  $digitalSolution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DigitalSolution $digitalSolution)
    {
        $this->authorize("digitalSolution.store");
        // dd($request);
        $data = $request->validate([
            'title' => 'required|string',
            'objective' => 'nullable|string',
            'detail' => 'nullable|string',
            'sector' => 'nullable',
            'focus_area' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        if ($request->hasFile("poster")) {
            $data['poster'] = $request->file('poster')->store('posters');
        }
        $digitalSolution->update($data);
        if ($digitalSolution) {
            //target group

            TargetGroup::where("digital_solution_id",$digitalSolution->id)->delete();

            if ($request['tgroup']) {
                $target_groups = [];
                foreach ($request['tgroup'] as $tgroup) {
                    array_push($target_groups, [
                        'name' => $tgroup['name'],
                        'digital_solution_id' => $digitalSolution->id,
                    ]);
                }
                TargetGroup::insert($target_groups);
            }
            if ($request['area']) {
                GeographicArea::where("digital_solution_id",$digitalSolution->id)->delete();

                $geographical_area = [];
                foreach ($request['area'] as $area) {
                    array_push($geographical_area, [
                        'name' => $area['name'],
                        'digital_solution_id' => $digitalSolution->id,
                    ]);
                }
                GeographicArea::insert($geographical_area);
            }

            // dd($request->hasFile("gallery"));
            if ($request["gallery"]) {

                $gallery_photos = [];

                // dd();
                foreach ($request->file('gallery') as $gallery) {
                    // dd();
                    $path = $gallery['photo']->store('Galleries');
                    array_push($gallery_photos, [
                        'path' => $path,
                        'digital_solution_id' => $digitalSolution->id,
                    ]);
                }
                // dd($gallery_photos);
                Gallery::insert($gallery_photos);
            }


            if ($request['team']) {
                $team_members = [];
                Team::where("digital_solution_id",$digitalSolution->id)->delete();

                foreach ($request['team'] as $team) {

                    array_push($team_members, [
                        'name' => $team['name'],
                        'email' => $team['email'],
                        'phone' => $team['phone'],
                        'digital_solution_id' => $digitalSolution->id,
                    ]);
                }
                Team::insert($team_members);
            }
            if ($request['part']) {
                Partner::where("digital_solution_id",$digitalSolution->id)->delete();

                $partner = [];
                $i = 0;
                // dd($request['part']);
                foreach ($request['part'] as $key => $part) {
                    // dd(isset($request->file("part")[$key]));
                    // dump($part);
                    $paths = isset($request->file("part")[$key])?$request->file("part")[$key]['logo']->store("Logos"):'';

                    array_push($partner, [
                        'name' => $part['name'],
                        'email' => $part['email'],
                        'url' => $part['url'],
                        'phone' => $part['phone'],
                        'type' => $part['type'],
                        'organization_type_id' => $part['organization_type_id'],
                        'logo' => $paths,
                        'digital_solution_id' => $digitalSolution->id,
                    ]);
                }
                // dd($partner);
                Partner::insert($partner);
            }
            return redirect()->route("digitalSolution.index")->with("success", "Sucessfully Updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DigitalSolution  $digitalSolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(DigitalSolution $digitalSolution)
    {

        $this->authorize("digitalSolution.destroy");
        if (
            (auth()->user()->id !== $digitalSolution->user_id) &&
            !(auth()->user()->hasRole(Constants::SUPER_ADMIN_ROLE) || auth()->user()->hasRole(Constants::ADMIN_ROLE))
        ) {
            dd("dfd");
            return back()->with("error", "You cannot Delete Other's Digital Solution");
        }
        $digitalSolution->delete();
        return redirect()
            ->route('digitalSolution.index')
            ->with('success', 'Successfully Deleted');
    }
}
