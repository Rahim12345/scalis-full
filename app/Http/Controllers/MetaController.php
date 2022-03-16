<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMetaRequest;
use App\Models\Meta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MetaController extends Controller
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
            $data = Meta::latest()
                ->get();

            return DataTables::of($data)

                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => Carbon::parse($row->created_at)->format('d-m-Y H:i:s'),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })

                ->addColumn('action',function ($row){
                    return '
                <div class="btn-list flex-nowrap">
                    <a class="btn btn-primary"
                    href="'.route('meta.edit',[$row->id]).'"><i class="fa fa-edit"></i></a>
                </div>
                ';
                })

                ->rawColumns(['action'])

                ->make(true);
        }

        return view('back.pages.meta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.pages.meta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMetaRequest $request)
    {
        $menus = [
            'main_page' => 'Ana Səhifə',
            'about_page' => 'Haqqımızda',
            'brends_page' => 'Brendlər',
            'career_page' => 'Karyeara',
            'blog_page' => 'Blog',
            'contact_page' => 'Əlaqə'
        ];
        $label = $menus[$request->menus];
        $prefix = $request->menus;
        $preData = [
            [
              'label'=>$label,
              'key'=>$request->menus.'_'.'name_title',
              'value'=>$request->name_title,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'label'=>$label,
                'key'=>$request->menus.'_'.'name_description',
                'value'=>$request->name_description,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'label'=>$label,
                'key'=>$request->menus.'_'.'property_og_site_name',
                'value'=>$request->property_og_site_name,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'label'=>$label,
                'key'=>$request->menus.'_'.'property_og_url',
                'value'=>$request->property_og_url,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'label'=>$label,
                'key'=>$request->menus.'_'.'property_og_title',
                'value'=>$request->property_og_title,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'label'=>$label,
                'key'=>$request->menus.'_'.'property_og_description',
                'value'=>$request->property_og_description,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'label'=>$label,
                'key'=>$request->menus.'_'.'property_twitter_url',
                'value'=>$request->property_twitter_url,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'label'=>$label,
                'key'=>$request->menus.'_'.'property_twitter_title',
                'value'=>$request->property_twitter_title,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],
            [
                'label'=>$label,
                'key'=>$request->menus.'_'.'property_twitter_description',
                'value'=>$request->property_twitter_description,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]
        ];
        Meta::where('key','like',$prefix.'%')->delete();
        Meta::insert($preData);

        toastSuccess(__('static.data_ugurla_elave_etildi'));
        return redirect()->route('meta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meta = Meta::findOrFail($id);
        return view('back.pages.meta.edit', compact('meta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $meta = Meta::findOrFail($id);
        $this->validate($request, [
            'edit_meta'=>'required|max:100'
        ],[],[
            'edit_meta'=>'Sahə'
        ]);

        $meta->update([
            'value'=>$request->edit_meta
        ]);

        toastSuccess(__('static.data_ugurla_yenilendi'));
        return redirect()->route('meta.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meta $meta)
    {
        //
    }
}
