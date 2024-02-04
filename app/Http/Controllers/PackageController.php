<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Package;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    private function sort_info($request)
    {
        $dir = 'asc';
        $sort = $request->sort;
        if (str_contains($sort, ' desc')) {
            $sort = str_replace(' desc', '', $sort);
            $dir = 'desc';
        }
        return [$sort, $dir];
    }

    public function index()
    {
        return view('package.index', ['packages' => package::orderBy('id', 'desc')->paginate(10)]);
    }

    public function group(Request $request, Group $group)
    {
        $sort = $this->sort_info($request);
        $ids = [];
        foreach ($group->children as $gs) {
            array_push($ids, $gs->id);
            foreach ($gs->children as $g) {
                array_push($ids, $g->id);
            }
        }
        return view('package.index', ['packages' => Package::whereIn('group_id', $ids)
            ->orderBy(($sort[0] ?? 'id'), $sort[1])->paginate(10), 'group' => $group]);
    }

    public function search(Request $request)
    {
        $sort = $this->sort_info($request);
        return view(
            'package.index',
            ['packages' => Package::where('title', 'LIKE', "%$request->q%")->orWhere('description', 'LIKE', "%$request->q%")
                ->orderBy(($sort[0] ?? 'id'), $sort[1])->paginate(10)]
        );
    }

    public function create()
    {
        return view('package.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            Rule::unique('packages'),
        ]);
        Package::create([
            'title' => $request->title,
            'slug' => Str::slug(__($request->title), dictionary: ['#' => 'sharp']),
            'description' => $request->description,
            'level' => 1,
            'user_id' => $request->user()->id,
        ]);
        return redirect(route('packages.index'));
    }

    public function show(Package $package)
    {
        return view('package.show', ['package' => $package]);
    }

    public function edit(Package $package)
    {
        return view('package.edit', ['package' => $package]);
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'description' => 'required|string',
            'title' => [
                'required',
                'string',
                Rule::unique('packages')->ignore($package->id),
            ]
        ]);

        $package->fill([
            'title' => $request->title,
            'slug' => Str::slug(__($request->title), dictionary: ['#' => 'sharp']),
            'description' => $request->description,
        ]);
        $package->save();

        return redirect(route('packages.show', ['package' => $package->slug]));
    }

    public function destroy(Package $package)
    {
        $package = $package;
        $package->delete();
        return redirect(route('packages.index'));
    }
}
