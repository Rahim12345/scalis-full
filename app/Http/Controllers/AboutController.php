<?php

namespace App\Http\Controllers;

use App\Helpers\Options;
use App\Models\About;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();
        return view('back.pages.about.index',compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.pages.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAboutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAboutRequest $request)
    {
        if($request->action == 'create')
        {
            $new_name = $this->imageUploader($request,'files/about/',1780,null);
            About::create([
                'banner_image'=>$new_name,
                'about_us_az'=>$request->about_us_az,
                'about_us_en'=>$request->about_us_en,
                'about_us_ru'=>$request->about_us_ru,
            ]);

            return response()->json(['message'=> __('static.data_ugurla_elave_etildi')], Response::HTTP_CREATED);
        }
        elseif($request->action == 'edit')
        {
            $about      = About::findOrFail($request->id);
            $new_name   = $about->banner_image;
            if($request->hasFile('image'))
            {
                if(File::exists(public_path('files/about/'.$about->banner_image)))
                {
                    File::delete(public_path('files/about/'.$about->banner_image));
                }
                $new_name = $this->imageUploader($request,'files/about/',1780,null);
            }

            About::whereId($request->id)->update([
                'banner_image'=>$new_name,
                'about_us_az'=>$request->about_us_az,
                'about_us_en'=>$request->about_us_en,
                'about_us_ru'=>$request->about_us_ru,
            ]);

            return response()->json(['message'=> __('static.data_ugurla_yenilendi')], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('back.pages.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAboutRequest  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAboutRequest $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        if(File::exists(public_path('files/about/'.$about->banner_image)))
        {
            File::delete(public_path('files/about/'.$about->banner_image));
        }
        $about->delete();

        toastSuccess('Data uğurla silindi');
        return redirect()->back();
    }

    public function imageUploader($request, $directory = '/',$width = null, $height = null)
    {
        $file           = $request->image;
        $new_name       = $file->hashName();

        $image_resize   = Image::make($file->getRealPath());
        $image_resize   = $image_resize->orientate();
        $image_resize->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image_resize->save(public_path($directory.$new_name));

        return $new_name;
    }

    public function AboutBanner()
    {
        return view('back.pages.about.banner');
    }

    public function AboutBannerPost(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048' // max 2048kb
        ]);

        $about_banner = Options::getOption('about_banner');
        if(File::exists(public_path('files/about/'.$about_banner))){
            File::delete(public_path('files/about/'.$about_banner));
        }

        $file       = $request->file('image');
        $newname    = $file->hashName();
        $file->move(public_path('files/about'), $newname);

        Option::updateOrCreate(
            ['key' => 'about_banner'],
            ['value' => $newname]
        );

        return response()->json(['message' => __('static.data_ugurla_elave_etildi')], Response::HTTP_CREATED);
    }
}
