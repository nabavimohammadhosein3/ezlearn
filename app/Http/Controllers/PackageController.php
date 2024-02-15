<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom_file_name;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Package;
use App\Models\Buy;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    use Custom_file_name;

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

    public function profile_buy(Request $request)
    {
        $user_buys = Buy::where('user_id', $request->user()->id)->where("buyable_type", Package::class);
        return view('profile.edit', [
            'packages' => Package::whereIn('id', $user_buys->pluck('buyable_id')->toArray())
                ->orderBy('id', 'desc')->paginate(10),
        ]);
    }
    public function profile_own(Request $request)
    {
        return view('profile.edit', [
            'packages' => package::where('user_id', $request->user()->id)
                ->orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function group(Request $request, Group $group)
    {
        $sort = $this->sort_info($request);
        $ids = [];
        array_push($ids, $group->id);
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
        if ($request->q == null) {
            return view(
                'package.index',
                ['packages' => Package::orderBy(($sort[0] ?? 'id'), $sort[1])->paginate(10)]
            );
        } else {
            return view(
                'package.index',
                ['packages' => Package::where('title', 'LIKE', "%$request->q%")->orWhere('description', 'LIKE', "%$request->q%")
                    ->orderBy(($sort[0] ?? 'id'), $sort[1])->paginate(10)]
            );
        }
    }

    public function create()
    {
        return view('package.create', ['groups', Group::orderBy('id', 'desc')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'string',
                Rule::unique('packages'),
            ],
            'description' => 'required|string',
            'level' => 'required|integer',
            'total_time' => 'required|integer',
            'group_id' => 'required|integer',
            'price' => 'required|integer',
        ]);
        $package = Package::create([
            'title' => $request->title,
            'slug' => Str::slug(__($request->title), dictionary: ['#' => 'sharp']),
            'description' => $request->description,
            'level' => $request->level,
            'total_time' => $request->total_time,
            'group_id' => $request->group_id,
            'price' => $request->price,
            'user_id' => $request->user()->id,
        ]);
        return redirect(route('packages.upload', ['package' => $package->slug]));
    }

    public function upload(Package $package)
    {
        return view('package.file_upload', ['package' => $package]);
    }

    public function file(Request $request, Package $package)
    {
        if ($request->file('picture') != null) {
            $picture = $request->file('picture');
            $picture_name = $this->custom_name(['picture', $package->id], $picture->getClientOriginalExtension());
            $picture_path = $picture->storeAs('public/picture/', $picture_name);
            $address = Storage::url($picture_path);
            $package->files()->updateOrCreate([
                'name' => 'picture'
            ], [
                'address' => $address
            ]);
        }

        if ($request->file('video') != null) {
            $video = $request->file('video');
            $video_name = $this->custom_name(['video', $package->id], $video->getClientOriginalExtension());
            $video_path = $video->storeAs('public/video/', $video_name);
            $address = Storage::url($video_path);
            $package->files()->updateOrCreate([
                'name' => 'video'
            ], [
                'address' => $address
            ]);
        }

        if ($request->file('file') != null) {
            $file = $request->file('file');
            $file_name = $this->custom_name(['file', $package->id], $file->getClientOriginalExtension());
            $file_path = $file->storeAs('public/file/', $file_name);
            $address = Storage::url($file_path);
            $package->files()->updateOrCreate([
                'name' => 'file'
            ], [
                'address' => $address
            ]);
        }

        return redirect(route('packages.show', ['package' => $package->slug]));
    }


    public function buy(Request $request, Package $package)
    {
        $package->buys()->create([
            'user_id' => $request->user()->id
        ]);
        return redirect()->back();
    }

    public function show(Request $request, Package $package)
    {
        if ($request->user() != null) {
            return view('package.show', [
                'package' => $package,
                'buy' => $package->buys()->where('user_id', $request->user()->id)->first()
            ]);
        } else {
            return view('package.show', [
                'package' => $package,
            ]);
        }
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
            ],
            'level' => 'required|integer',
            'total_time' => 'required|integer',
            'group_id' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $package->fill([
            'title' => $request->title,
            'slug' => Str::slug(__($request->title), dictionary: ['#' => 'sharp']),
            'level' => $request->level,
            'total_time' => $request->total_time,
            'group_id' => $request->group_id,
            'price' => $request->price,
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
