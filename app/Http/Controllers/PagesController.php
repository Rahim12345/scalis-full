<?php

namespace App\Http\Controllers;

use App\Events\ContactMessage;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\StoreCareerRequest;
use App\Mail\ContactEmail;
use App\Models\About;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Cv;
use App\Models\Foto;
use App\Models\MainMenu;
use App\Models\Meta;
use App\Models\Product;
use App\Models\SubOneMenu;
use App\Models\SubTwoMenu;
use App\Models\Subscriber;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class PagesController extends Controller
{
    public $prefix;
    public $name_title;
    public $name_description;
    public $property_og_site_name;
    public $property_og_url;
    public $property_og_title;
    public $property_og_description;
    public $property_twitter_url;
    public $property_twitter_title;
    public $property_twitter_description;

    public function meta()
    {
        $routeName = Route::currentRouteName();
        if ($routeName == 'front.home')
        {
            $this->prefix = 'main_page_';
        }
        elseif ($routeName == 'front.about')
        {
            $this->prefix = 'about_page_';
        }
        elseif ($routeName == 'front.brends')
        {
            $this->prefix = 'brends_page_';
        }
        elseif ($routeName == 'front.career')
        {
            $this->prefix = 'career_page_';
        }
        elseif ($routeName == 'front.contact')
        {
            $this->prefix = 'contact_page_';
        }
        elseif ($routeName == 'front.contact')
        {
            $this->prefix = 'blog_page_';
        }
        else
        {
            $this->prefix = '';
        }

        $meta = Meta::where('key','like',$this->prefix.'%')->get();
        if ($meta->count() == 9)
        {
            foreach($meta as $item)
            {
                $value = explode('***', $item->value);
                if (app()->getLocale() == 'az')
                {
                    $value  = $value[0];
                }
                elseif (app()->getLocale() == 'en')
                {
                    $value  = $value[1];
                }
                else
                {
                    $value  = $value[2];
                }

                if ($item->key == $this->prefix.'name_title')
                {
                    $this->name_title = $value;
                }
                elseif ($item->key == $this->prefix.'name_description')
                {
                    $this->name_description = $value;
                }
                elseif ($item->key == $this->prefix.'property_og_site_name')
                {
                    $this->property_og_site_name = $value;
                }
                elseif ($item->key == $this->prefix.'property_og_url')
                {
                    $this->property_og_url = $value;
                }
                elseif ($item->key == $this->prefix.'property_og_title')
                {
                    $this->property_og_title = $value;
                }
                elseif ($item->key == $this->prefix.'property_og_description')
                {
                    $this->property_og_description = $value;
                }
                elseif ($item->key == $this->prefix.'property_twitter_url')
                {
                    $this->property_twitter_url = $value;
                }
                elseif ($item->key == $this->prefix.'property_twitter_title')
                {
                    $this->property_twitter_title = $value;
                }
                elseif ($item->key == $this->prefix.'property_twitter_description')
                {
                    $this->property_twitter_description = $value;
                }
            }
        }
        else
        {
            $this->name_title = '';
            $this->name_description = '';
            $this->property_og_site_name = '';
            $this->property_og_url = '';
            $this->property_og_title = '';
            $this->property_og_description = '';
            $this->property_twitter_url = '';
            $this->property_twitter_title = '';
            $this->property_twitter_description = '';
        }

        View::share([
            'name_title'=>$this->name_title,
            'name_description'=>$this->name_description,
            'property_og_site_name'=>$this->property_og_site_name,
            'property_og_url'=>$this->property_og_url,
            'property_og_title'=>$this->property_og_title,
            'property_og_description'=>$this->property_og_description,
            'property_twitter_url'=>$this->property_twitter_url,
            'property_twitter_title'=>$this->property_twitter_title,
            'property_twitter_description'=>$this->property_twitter_description,
        ]);
    }

    public function home()
    {
        $this->meta();
        return view('front.pages.home');
    }

    public function subscribe(Request $request)
    {
        $client  = new Client();
        $arrResponse = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'secret' => env('RECAPTCHAV3_SECRET'),
                'response' => $request->token,
            ],
        ]);

        $arrResponse = json_decode($arrResponse->getBody(), true);

        if($arrResponse["success"] == '1' && $arrResponse["action"] == 'subscribe' && $arrResponse["score"] >= 0.5)
        {
            $this->validate($request, [
                'email' => 'required|email|unique:subscribers,email',
            ],[],[
                'email' => __('login.email'),
            ]);

            Subscriber::create([
                'email' => $request->email,
            ]);

            return response()->json([
                'message' => __('static.subscribe_success'),
            ],Response::HTTP_OK);
        }
        else
        {
            return response()->json([
                'errors'=>[
                    'bot'=>__('static.bot')
                ]
            ], 422);
        }
    }

    public function about()
    {
        $this->meta();
        return view('front.pages.about',[
            'about' => About::get()
        ]);
    }

    public function brends()
    {
        $this->meta();
        return view('front.pages.brends',[
            'brends' => \App\Models\Brend::all()
        ]);
    }

    public function career()
    {
        $this->meta();
        return view('front.pages.career');
    }

    public function careerPost(StoreCareerRequest $request)
    {
        $cv                 = $this->fileUploader($request, 'getFileCv');
        $characteristics    = $this->fileUploader($request, 'getFileCharacteristics');

        Cv::create([
            'cv'=>$cv,
            'characteristics'=>$characteristics,
            'ip'=>$request->ip()
        ]);


        $message = __('static.career_success');
        if(!$request->hasFile('getFileCharacteristics'))
        {
            if (app()->getLocale() == 'az')
            {
                $message = 'CV uğurla göndərildi';
            }
            elseif (app()->getLocale() == 'en')
            {
                $message = 'CV was sent successfully';
            }
            elseif (app()->getLocale() == 'ru')
            {
                $message = 'Резюме успешно отправлено';
            }
        }

        return \response()->json([
            'message' => $message,
        ],Response::HTTP_OK);
    }

    public function fileUploader($request, $field)
    {
        if ($request->file($field))
        {
            $file               = $request->file($field);
            $filename           = pathinfo( $file->getClientOriginalName(), PATHINFO_FILENAME );
            $newname           = str_slug($filename . time()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('back/cvs'), $newname);
            return $newname;
        }
    }

    public function contact()
    {
        $this->meta();
        return view('front.pages.contact');
    }

    public function contactPost(ContactRequest $request)
    {
        $this->meta();
        $contact = Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'telno'=>$request->telno,
            'message'=>$request->message,
            'ip'=>$request->ip()
        ]);

        event(new ContactMessage($contact));
        return \response()->json([
            'message' => __('static.contact_success'),
        ],Response::HTTP_OK);
    }

    public function productsMain_menu($main_menu)
    {
        $this->meta();
        $main_menu = MainMenu::with('sub_one_menus')->where('slug_az',$main_menu)->orWhere('slug_en',$main_menu)->orWhere('slug_ru',$main_menu)->firstOrFail();

        return view('front.pages.products',[
            'main_menus' => \App\Models\MainMenu::all(),
            'cari'=>$main_menu
        ]);
    }

    public function productsMain_menuSubMenu_1($main_menu, $sub_menu_1)
    {
        $this->meta();
        $main_menu = MainMenu::with('sub_one_menus')->where('slug_az',$main_menu)->orWhere('slug_en',$main_menu)->orWhere('slug_ru',$main_menu)->firstOrFail();
        $sub_menu_1 = SubOneMenu::with('sub_two_menus')->where('slug_az',$sub_menu_1)->orWhere('slug_en',$sub_menu_1)->orWhere('slug_ru',$sub_menu_1)->firstOrFail();

        return view('front.pages.products-sub-menu-1',[
            'main_menu'=>$main_menu,
            'sub_menu_1'=>$sub_menu_1
        ]);
    }

    public function productsMain_menuSubMenu_1SubMenu_2($main_menu, $sub_menu_1, $sub_menu_2)
    {
        $this->meta();
        $main_menu = MainMenu::with('sub_one_menus')->where('slug_az',$main_menu)->orWhere('slug_en',$main_menu)->orWhere('slug_ru',$main_menu)->firstOrFail();
        $sub_menu_1 = SubOneMenu::with('sub_two_menus')->where('slug_az',$sub_menu_1)->orWhere('slug_en',$sub_menu_1)->orWhere('slug_ru',$sub_menu_1)->firstOrFail();
        $sub_menu_2 = SubTwoMenu::with('getProducts')->where('slug_az',$sub_menu_2)->orWhere('slug_en',$sub_menu_2)->orWhere('slug_ru',$sub_menu_2)->firstOrFail();

        return view('front.pages.products-sub-menu-2',[
            'main_menu' => $main_menu,
            'sub_menu_1'=>$sub_menu_1,
            'sub_menu_2'=>$sub_menu_2
        ]);
    }

    public function productsMain_menuSubMenu_1SubMenu_2ProductSlug($main_menu, $sub_menu_1, $sub_menu_2,$product_slug)
    {
        $this->meta();
        $main_menu = MainMenu::with('sub_one_menus')->where('slug_az',$main_menu)->orWhere('slug_en',$main_menu)->orWhere('slug_ru',$main_menu)->firstOrFail();
        $sub_menu_1 = SubOneMenu::with('sub_two_menus')->where('slug_az',$sub_menu_1)->orWhere('slug_en',$sub_menu_1)->orWhere('slug_ru',$sub_menu_1)->firstOrFail();
        $sub_menu_2 = SubTwoMenu::with('getProducts')->where('slug_az',$sub_menu_2)->orWhere('slug_en',$sub_menu_2)->orWhere('slug_ru',$sub_menu_2)->firstOrFail();
        $product    = Product::where('slug_az',$product_slug)->firstOrFail();

        return view('front.pages.product-details', compact('product'));
    }

    public function blog()
    {
        $this->meta();
        return view('front.pages.blog',[
            'firstBlog'=>Blog::orderBy('id','desc')->first(),
        ]);
    }

    public function blogPost(Request $request)
    {
        if(isset($_POST["limit"], $_POST["start"]))
        {
            $blogs = Blog::orderBy('id','desc')->offset($_POST["start"])->limit($_POST["limit"])->get()->toArray();

            foreach($blogs as $row)
            {
                echo '
                  <figure class="blog_one" onclick="window.location.href=\''.route('front.blog.single',['slug'=>$row['slug_'.app()->getLocale()]]).'\'">
                        <img src="'.asset($row['cover']).'" alt="">
                        <h3>'.(mb_strlen($row['title_'.app()->getLocale()]) >= 30 ? mb_substr($row['title_'.app()->getLocale()],0, 30).'....' : $row['title_'.app()->getLocale()]).'</h3>
                        <p>'.(mb_strlen($row['sub_title_'.app()->getLocale()]) >=40 ? mb_substr($row['sub_title_'.app()->getLocale()],0, 40).'....' : $row['sub_title_'.app()->getLocale()]).'</p>
                        <figcaption>
                        </figcaption>
                    </figure>
                  ';
            }
        }
    }

    public function blogSingle($slug)
    {
        $this->meta();
        $blog = Blog::where('slug_az',$slug)
            ->orWhere('slug_en',$slug)
            ->orWhere('slug_ru',$slug)
            ->firstOrFail();
        $blog->increment('hits');
        return view('front.pages.blog-single', compact('blog'));
    }

    public function showroom()
    {
        $this->meta();
        return view('front.pages.showroom',[
            'fotos'=>Foto::all()
        ]);
    }
}
