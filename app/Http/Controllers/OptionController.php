<?php

namespace App\Http\Controllers;

use App\Helpers\Options;
use App\Models\Option;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.pages.options',[
            'unvan'=>Options::getOption('unvan'),
            'tel'=>Options::getOption('tel'),
            'email'=>Options::getOption('email'),
            'facebook'=>Options::getOption('facebook'),
            'instagram'=>Options::getOption('instagram'),
            'youtube'=>Options::getOption('youtube')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOptionRequest $request)
    {
        $check_add = Options::getOption('tel') == '' ? true : false;
        foreach ($request->keys() as $key)
        {
            if ($key != '_token')
            {
                Option::updateOrCreate(
                    ['key'   => $key],
                    [
                        'value' => $request->post($key)
                    ]
                );
            }
        }

        if ($check_add)
        {
            toastr()->success(__('static.data_ugurla_elave_etildi'));
        }
        else
        {
            toastr()->success(__('static.data_ugurla_yenilendi'));
        }

        return redirect()->route('option.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOptionRequest  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }

    public function blogBanner()
    {
        return view('back.pages.blog.banner');
    }

    public function blogBannerPost(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048' // max 2048kb
        ],[],[
            'image' => 'Banner'
        ]);

        $blog_banner = Options::getOption('blog_banner');
        if(File::exists(public_path('files/blogs/'.$blog_banner))){
            File::delete(public_path('files/blogs/'.$blog_banner));
        }

        $file       = $request->file('image');
        $newname    = $file->hashName();
        $file->move(public_path('files/blogs'), $newname);

        Option::updateOrCreate(
            ['key' => 'blog_banner'],
            ['value' => $newname]
        );

        return response()->json(['message' => __('static.data_ugurla_elave_etildi')], Response::HTTP_CREATED);
    }

    public function showroomBanner()
    {
        return view('back.pages.showroom.banner');
    }

    public function showroomBannerPost(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048' // max 2048kb
        ],[],[
            'image' => 'Banner'
        ]);

        $blog_banner = Options::getOption('show_banner');
        if(File::exists(public_path('files/showroom/'.$blog_banner))){
            File::delete(public_path('files/showroom/'.$blog_banner));
        }

        $file       = $request->file('image');
        $newname    = $file->hashName();
        $file->move(public_path('files/showroom'), $newname);

        Option::updateOrCreate(
            ['key' => 'show_banner'],
            ['value' => $newname]
        );

        return response()->json(['message' => __('static.data_ugurla_elave_etildi')], Response::HTTP_CREATED);
    }
}
