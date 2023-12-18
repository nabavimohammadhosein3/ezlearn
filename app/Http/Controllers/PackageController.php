<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        return view('package.index', ['packages' => Package::paginate(10)]);
    }

    public function create()
    {
        return view('package.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);
        Package::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, dictionary: ['#' => 'sharp']),
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);
        return redirect(route('packages.index'));
    }

    public function show(string $slug)
    {
        return view('package.show', ['package' => Package::where('slug', $slug)->first()]);
    }

    public function edit(string $slug)
    {
        return view('package.edit', ['package' => Package::where('slug', $slug)->first()]);
    }

    public function update(Request $request, string $slug)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);

        $package = Package::where('slug', $slug)->first();
        $package->fill([
            'title' => $request->title,
            'slug' => Str::slug($request->title, dictionary: ['#' => 'sharp']),
            'description' => $request->description,
        ]);
        $package->save();

        return redirect(route('packages.show', ['package' => $package->slug]));
    }

    public function destroy(string $slug)
    {
        $package = Package::where('slug', $slug)->first();
        $package->delete();
        return redirect(route('packages.index'));
    }
}
