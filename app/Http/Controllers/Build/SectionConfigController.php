<?php

namespace App\Http\Controllers\Build;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Services\Build\SectionConfigBuildService;
use App\Models\Build\SectionConfigBuild;

class SectionConfigController extends Controller
{
    public function index(Request $request)
    {
        $sections = SectionConfigBuildService::_paging($request);
        return view('modules.build.section-config.index', compact('sections'));
    }

    public function create()
    {
        return view('modules.build.section-config.create');
    }

    public function store(Request $request)
    {
        if (SectionConfigBuildService::_storing($request->input('config'))) {
            return redirect()->route('section.config.index');
        }
        return back()
            ->with('error', 'Sorry, could not create section config at this time. Please try again later.');
    }

    public function get_section($uuid)
    {
        $section = SectionConfigBuildService::_find($uuid);
        $section = SectionConfigBuild::single_format($section);

        $type_contents = get_list_group('type_contents'); 
        $website_styles = get_list_group('website_styles'); 
        $website_scripts = get_list_group('website_scripts'); 

        $view = 'modules.build.section-config.update.section';
        $html = view($view, compact('section', 'type_contents', 'website_styles', 'website_scripts'))->render();

        return response()->json([
            'status' => 'success', 
            'filename' => $section['filename'],
            'size' => Storage::size('public/cms/section/'.$section['filename']),
            'html' => $html
        ], 200);
    }

    public function update(Request $request, $uuid)
    {
        if (SectionConfigBuildService::_updating($request->input('config'), $uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not update section config at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (SectionConfigBuildService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the section config at this time. Please try again later.');
    }

    public function upload_image(Request $request)
    {
        ini_set('memory_limit', '256M');
        ini_set('upload_max_filesize', '24M');
        ini_set('post_max_size', '32M');

        if (!$request->hasFile('image')) {
            return response()->json(['status' => 'failed'], 200);
        }

        $image = $request->file('image');
        $filename = SectionConfigBuildService::_new_filename($request->file('image'));

        if ($image->storeAs('public/cms/section', $filename)) {

            $type_contents = get_list_group('type_contents'); 
            $website_styles = get_list_group('website_styles'); 
            $website_scripts = get_list_group('website_scripts'); 

            $view = 'modules.build.section-config.create.section';
            $html = view($view, compact('filename', 'type_contents', 'website_styles', 'website_scripts'))->render();

            return response()->json([
                'status' => 'success', 
                'filename' => $filename,
                'html' => $html
            ], 200);
        }
        return response()->json(['status' => 'failed'], 200);
    }

    public function remove_image(Request $request)
    {
        Storage::delete('public/cms/section/' . $request->image);
        return response()->json(['status' => 'success'], 200);
    }

    public function generate_form(Request $request)
    {
        $count = $request->count + 1;
        $indexing = $request->indexing;
        
        $view = 'modules.build.section-config.create.list-item';
        $html = view($view, compact('count', 'indexing'))->render();

        return response()->json([
            'status' => 'success', 
            'html' => $html
        ], 200);
    }
}