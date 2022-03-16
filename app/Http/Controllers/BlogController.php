<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Blog::latest()
                ->get();

            return DataTables::of($data)

                ->editColumn('cover', function ($row) {
                    return '<img style="width:50px;height:50px" src="'.asset('files/blogs/'.$row->cover).'" alt="'.$row->{'title_'.app()->getLocale()}.'" />';
                })

                ->addColumn('status',function ($row){
                    return $row->status != 1 ? '<span style="cursor: pointer" class="badge bg-danger">gizlidir</span>' : '<span style="cursor: pointer" class="badge bg-success">görünür</span>';
                })

                ->addColumn('title',function ($row){
                    return $row->{'title_'.app()->getLocale()};
                })

                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => Carbon::parse($row->created_at)->format('d-m-Y H:i:s'),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })

                ->addColumn('action',function ($row){
                    return '
                <div class="btn-list flex-nowrap">
                <form action="'.route('back-blog.destroy',$row->id).'" method="POST">
                '.@csrf_field().'
                '.@method_field('DELETE').'
                <button class="btn btn-danger" type="submit" onclick="return confirm(\'Silmek istədiyinizdən əminsiniz?\')"><i class="fa fa-times"></i></button>
                </form>
                    <a class="btn btn-primary"
                    href="'.route('back-blog.edit',[$row->id]).'"><i class="fa fa-edit"></i></a>
                </div>
                ';
                })

                ->rawColumns(['cover','action','status'])

                ->make(true);
        }

        return view('back.pages.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.pages.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $file       = $request->image;
        $new_name   = $file->hashName();
        $file->move(public_path('files/blogs'),$new_name);

        Blog::create([
            'cover'=>$new_name,
            'title_az'=>$request->title_az,
            'slug_az'=>str_slug($request->title_az),
            'title_en'=>$request->title_en,
            'slug_en'=>str_slug($request->title_en),
            'title_ru'=>$request->title_ru,
            'slug_ru'=>str_slug($request->title_ru),
            'sub_title_az'=>$request->sub_title_az,
            'sub_title_en'=>$request->sub_title_en,
            'sub_title_ru'=>$request->sub_title_ru,
            'content_az'=>$request->content_az,
            'content_en'=>$request->content_en,
            'content_ru'=>$request->content_ru
        ]);

        toastSuccess(__('static.data_ugurla_elave_etildi'));
        return redirect()->route('back-blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('back.pages.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request,$id)
    {
        $blog = Blog::findOrFail($id);
        $new_name   = $blog->cover;
        if ($request->image)
        {
            if (File::exists(public_path('files/blogs/'.$blog->cover)))
            {
                File::delete('files/blogs/'.$blog->cover);
            }

            $file = $request->image;
            $new_name   = $file->hashName();
            $file->move(public_path('files/blogs'),$new_name);
        }

        $blog->update([
            'cover'=>$new_name,
            'title_az'=>$request->title_az,
            'slug_az'=>str_slug($request->title_az),
            'title_en'=>$request->title_en,
            'slug_en'=>str_slug($request->title_en),
            'title_ru'=>$request->title_ru,
            'slug_ru'=>str_slug($request->title_ru),
            'sub_title_az'=>$request->sub_title_az,
            'sub_title_en'=>$request->sub_title_en,
            'sub_title_ru'=>$request->sub_title_ru,
            'content_az'=>$request->content_az,
            'content_en'=>$request->content_en,
            'content_ru'=>$request->content_ru
        ]);

        toastSuccess('static.data_ugurla_yenilendi');
        return redirect()->route('back-blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if (File::exists(public_path('files/blogs/'.$blog->cover)))
        {
            File::delete('files/blogs/'.$blog->cover);
        }

        $blog->delete();
        toastSuccess(__('static.data_ugurla_silindi'));

        return redirect()->back();
    }
}
