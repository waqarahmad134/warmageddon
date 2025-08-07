<?php

namespace App\Http\Controllers\Backend\cms;

use App\CMS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    public function site_setting()
    {
        $data                                  = DB::table('cms')->find(1);
        return view('backend.cms.index',compact('data'));
    }
    public function save_site_setting(Request $request)
    {
        $request->validate([
            'site_icon'         => 'dimensions:width=270,height=295',
            'logo'              => 'dimensions:width=1326,height=304',
            'banner_side_img'   => 'dimensions:width=601,height=867',
            'banner_bg_img'     => 'dimensions:width=1920,height=1080',
            'banner_btn'        => 'dimensions:width=446,height=129',
            'welcome_bg'        => 'dimensions:width=1920,height=301',
            'welcome_btn'       => 'dimensions:width=374,height=135',
            'winner_bg'         => 'dimensions:width=1920,height=650',
            'winner_side_imag'  => 'dimensions:width=620,height=563',
            'winner_btn'        => 'dimensions:width=374,height=135',
            'promotion_bg'      => 'dimensions:width=1920,height=1080',
            'promotion_side_img' => 'dimensions:width=665,height=778',
            'promotion1_bg'      => 'dimensions:width=1920,height=1080',
            'promotion1_icon1'   => 'dimensions:width=184,height=184',
            'promotion1_icon2'   => 'dimensions:width=184,height=184',
            'promotion1_icon3'   => 'dimensions:width=184,height=184',
            'promotion1_icon4'   => 'dimensions:width=184,height=184',
            'promotion1_icon5'   => 'dimensions:width=184,height=184',
            'top_footer_bg'      => 'dimensions:width=1920,height=888',
            'top_footer_icon1'   => 'dimensions:width=818,height=673',
            'top_footer_icon2'   => 'dimensions:width=818,height=673',
            'top_footer_icon3'   => 'dimensions:width=818,height=673',
            'footer_payment_icon1' => 'dimensions:width=150,height=90',
            'footer_payment_icon2' => 'dimensions:width=150,height=90',
            'footer_payment_icon3' => 'dimensions:width=150,height=90',
            'footer_payment_icon4' => 'dimensions:width=150,height=90',
            'client_img1'           => 'dimensions:width=101,height=68',
            'client_img2'           => 'dimensions:width=101,height=68',
            'client_img3'           => 'dimensions:width=101,height=68',
            'client_img4'           => 'dimensions:width=101,height=68',
            'client_img5'           => 'dimensions:width=101,height=68',
            'client_promo_icon1'    => 'dimensions:width=56,height=56',
        ]);
        $input = $request->all();
        if (CMS::all()->count() > 0) {
            $site = CMS::where('id','>',0)->orderBy('created_at','asc')->first();

        } else {
            $site = new CMS();
        }
//        try {
            if ($request->file('site_icon')) {
                $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->site_icon->getClientOriginalName();
                $request->site_icon->move(base_path('images/icons'), $icon);
                $site->site_icon = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
            }
            if ($request->file('logo')) {
                $logo = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->logo->getClientOriginalName();
                $request->logo->move(base_path('images/logos'), $logo);
                $site->logo = 'https://' . $request->getHttpHost() . '/images/logos/' . $logo;
            }
            if ($request->file('banner_side_img')) {
                $side_image = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->banner_side_img->getClientOriginalName();
                $request->banner_side_img->move(base_path('images/banners'), $logo);
                $site->banner_side_img = 'https://' . $request->getHttpHost() . '/images/banners/' . $side_image;
            }
            if ($request->file('banner_bg_img')) {
                $bg_image = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->banner_bg_img->getClientOriginalName();
                $request->banner_bg_img->move(base_path('images/banners'), $bg_image);
                $site->banner_bg_img = 'https://' . $request->getHttpHost() . '/images/banners/' . $bg_image;
            }
        if ($request->file('banner_btn')) {
            $banner_btn = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->banner_btn->getClientOriginalName();
            $request->banner_btn->move(base_path('images/banners'), $banner_btn);
            $site->banner_btn = 'https://' . $request->getHttpHost() . '/images/banners/' . $banner_btn;
        }
        if ($request->file('welcome_bg')) {
            $welcome_image = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->welcome_bg->getClientOriginalName();
            $request->welcome_bg->move(base_path('images/banners'), $welcome_image);
            $site->welcome_bg = 'https://' . $request->getHttpHost() . '/images/banners/' . $welcome_image;
        }
        if ($request->file('welcome_btn')) {
            $welcome_btn = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->welcome_btn->getClientOriginalName();
            $request->welcome_btn->move(base_path('images/banners'), $welcome_btn);
            $site->welcome_btn = 'https://' . $request->getHttpHost() . '/images/banners/' . $welcome_btn;
        }
        // top winners
        if ($request->file('winner_bg')) {
            $winner_bg = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->winner_bg->getClientOriginalName();
            $request->winner_bg->move(base_path('images/banners'), $winner_bg);
            $site->winner_bg = 'https://' . $request->getHttpHost() . '/images/banners/' . $winner_bg;
        }
        if ($request->file('winner_side_image')) {
            $winner_side_image = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->winner_side_image->getClientOriginalName();
            $request->winner_side_image->move(base_path('images/banners'), $winner_side_image);
            $site->winner_side_image = 'https://' . $request->getHttpHost() . '/images/banners/' . $winner_side_image;
        }
        if ($request->file('winner_btn')) {
            $winner_btn = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->winner_btn->getClientOriginalName();
            $request->winner_btn->move(base_path('images/banners'), $winner_btn);
            $site->winner_btn = 'https://' . $request->getHttpHost() . '/images/banners/' . $winner_btn;
        }
        //promotion
        if ($request->file('promotion_bg')) {
            $promotion_bg= (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->promotion_bg->getClientOriginalName();
            $request->promotion_bg->move(base_path('images/banners'), $promotion_bg);
            $site->promotion_bg = 'https://' . $request->getHttpHost() . '/images/banners/' . $promotion_bg;
        }
        if ($request->file('promotion1_bg')) {
            $promotion1_bg= (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->winner_btn->getClientOriginalName();
            $request->promotion1_bg->move(base_path('images/banners'), $promotion1_bg);
            $site->promotion1_bg = 'https://' . $request->getHttpHost() . '/images/banners/' . $promotion1_bg;
        }
        if ($request->file('promotion_side_img')) {
            $promotion_side_img = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->promotion_side_img->getClientOriginalName();
            $request->winner_btn->move(base_path('images/banners'), $promotion_side_img);
            $site->promotion_side_img = 'https://' . $request->getHttpHost() . '/images/banners/' . $promotion_side_img;
        }
        //promotion icons
        if ($request->file('promotion1_icon1')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->promotion1_icon1->getClientOriginalName();
            $request->promotion1_icon1->move(base_path('images/icons'), $icon);
            $site->promotion1_icon1 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('promotion1_icon2')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->promotion1_icon2->getClientOriginalName();
            $request->promotion1_icon2->move(base_path('images/icons'), $icon);
            $site->promotion1_icon2 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('promotion1_icon3')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->promotion1_icon3->getClientOriginalName();
            $request->promotion1_icon3->move(base_path('images/icons'), $icon);
            $site->promotion1_icon3 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('promotion1_icon4')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->promotion1_icon4->getClientOriginalName();
            $request->promotion1_icon4->move(base_path('images/icons'), $icon);
            $site->promotion1_icon4 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('promotion1_icon5')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->promotion1_icon5->getClientOriginalName();
            $request->promotion1_icon5->move(base_path('images/icons'), $icon);
            $site->promotion1_icon5 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        // top header
        if ($request->file('top_footer_icon1')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->top_footer_icon1->getClientOriginalName();
            $request->top_footer_icon1->move(base_path('images/icons'), $icon);
            $site->top_footer_icon1 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('top_footer_icon2')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->top_footer_icon2->getClientOriginalName();
            $request->top_footer_icon2->move(base_path('images/icons'), $icon);
            $site->top_footer_icon2 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('top_footer_icon3')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->top_footer_icon3->getClientOriginalName();
            $request->top_footer_icon3->move(base_path('images/icons'), $icon);
            $site->top_footer_icon3 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        //footer icons
        if ($request->file('footer_payment_icon1')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->footer_payment_icon1->getClientOriginalName();
            $request->footer_payment_icon1->move(base_path('images/icons'), $icon);
            $site->footer_payment_icon1 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('footer_payment_icon2')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->footer_payment_icon2->getClientOriginalName();
            $request->footer_payment_icon2->move(base_path('images/icons'), $icon);
            $site->footer_payment_icon2 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('footer_payment_icon3')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->footer_payment_icon3->getClientOriginalName();
            $request->footer_payment_icon3->move(base_path('images/icons'), $icon);
            $site->footer_payment_icon3 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('footer_payment_icon4')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->footer_payment_icon4->getClientOriginalName();
            $request->footer_payment_icon4->move(base_path('images/icons'), $icon);
            $site->footer_payment_icon4 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        //client images and icons
        if ($request->file('client_img1')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->client_img1->getClientOriginalName();
            $request->client_img1->move(base_path('images/icons'), $icon);
            $site->client_img1 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('client_img2')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->client_img2->getClientOriginalName();
            $request->client_img2->move(base_path('images/icons'), $icon);
            $site->client_img2 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('client_img3')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->client_img3->getClientOriginalName();
            $request->client_img3->move(base_path('images/icons'), $icon);
            $site->client_img3 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('client_img4')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->client_img4->getClientOriginalName();
            $request->client_img4->move(base_path('images/icons'), $icon);
            $site->client_img4 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('client_img5')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->client_img5->getClientOriginalName();
            $request->client_img5->move(base_path('images/icons'), $icon);
            $site->client_img5 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }
        if ($request->file('client_promo_icon1')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->client_promo_icon1->getClientOriginalName();
            $request->client_promo_icon1->move(base_path('images/icons'), $icon);
            $site->client_promo_icon1 = 'https://' . $request->getHttpHost() . '/images/icons/' . $icon;
        }

            $site->site_title               = $input['site_title'];
            $site->menu_text1               = $input['menu_text1'];
            $site->menu_text2               = $input['menu_text2'];
            $site->menu_text3               = $input['menu_text3'];
            $site->menu_text4               = $input['menu_text4'];
            $site->menu_text5               = $input['menu_text5'];
            $site->menu_btn1                = $input['menu_btn1'];
            $site->menu_btn2                = $input['menu_btn2'];
            $site->banner_heading           = $input['banner_heading'];
            $site->banner_text              = $input['banner_text'];
            $site->welcome_heading          = $input['welcome_heading'];
            $site->welcome_text             = $input['welcome_text'];
            $site->winner_heading           = $input['winner_heading'];
            $site->winner_theading1         = $input['winner_theading1'];
            $site->winner_theading2         = $input['winner_theading2'];
            $site->winner_theading3         = $input['winner_theading3'];
            $site->winner_tdata1            = $input['winner_tdata1'];
            $site->winner_tdata2            = $input['winner_tdata2'];
            $site->winner_tdata3            = $input['winner_tdata3'];
            $site->winner_tdata4            = $input['winner_tdata4'];
            $site->winner_tdata5            = $input['winner_tdata5'];
            $site->winner_tdata6            = $input['winner_tdata6'];
            $site->winner_tdata7            = $input['winner_tdata7'];
            $site->winner_tdata8            = $input['winner_tdata8'];
            $site->winner_tdata9            = $input['winner_tdata9'];
            $site->winner_tdata10           = $input['winner_tdata10'];
            $site->winner_tdata11           = $input['winner_tdata11'];
            $site->winner_tdata12           = $input['winner_tdata12'];
            //promotion section
            $site->promotion_heading1       = $input['promotion_heading1'];
            $site->promotion_text1          = $input['promotion_text1'];
            $site->promotion_heading2       = $input['promotion_heading2'];
            $site->promotion_text2          = $input['promotion_text2'];
            $site->promotion1_heading1      = $input['promotion1_heading1'];
            $site->promotion1_heading2      = $input['promotion1_heading2'];
            $site->promotion1_text1         = $input['promotion1_text1'];
            $site->promotion1_text2         = $input['promotion1_text2'];
            // top footer
            $site->top_footer_text1         = $input['top_footer_text1'];
            $site->top_footer_text2         = $input['top_footer_text2'];
            $site->top_footer_text3         = $input['top_footer_text3'];
            // footer
            $site->footer_contact_header    = $input['footer_contact_header'];
            $site->footer_phone_no          = $input['footer_phone_no'];
            $site->footer_email             = $input['footer_email'];
            $site->footer_address           = $input['footer_address'];
            $site->footer_payment_header    = $input['footer_payment_header'];
            $site->footer_promo_statement   = $input['footer_promo_statement'];
            $site->footer_fb_icon           = $input['footer_fb_icon'];
            $site->footer_tel_icon          = $input['footer_tel_icon'];
            $site->footer_twit_icon         = $input['footer_twit_icon'];
            $site->footer_linked_icon       = $input['footer_linked_icon'];
            $site->client_promo_statement   = $input['client_promo_statement'];
            //lower Footer
            $site->subscribe_header         = $input['subscribe_header'];
            $site->subscribe_input_text     = $input['subscribe_input_text'];
            $site->subscribe_btn            = $input['subscribe_btn'];
            $site->copy_right_statement     = $input['copy_right_statement'];
            $site->footer_link              = $input['footer_link'];
            $site->footer_link2             = $input['footer_link2'];
            $site->footer_link3             = $input['footer_link3'];
            $site->footer_link4             = $input['footer_link4'];
            $site->footer_link5             = $input['footer_link5'];
            $site->footer_link6             = $input['footer_link6'];
            $site->chat_script              = $input['chat_script'];
            $site->sendgrid_secret          = $input['sendgrid_secret'];
            $site->stripe_form              = $input['stripe_form'];
            //payment gateways
//            $site->coingate_token           = $input['coingate_token'];
//            $site->stripe_key               = $input['stripe_key'];
            $site->save();
        Toastr::success('Site updated successfully!','Success');
            return redirect()->back();
//        } catch (\Exception $e) {
//            Toastr::error('Something went wrong try again!','Error');
//            return redirect()->back();
//        }

    }
    public function remove_img($name)
    {
        switch ($name)
        {
            case 'site_icon':
             $img = CMS::orderBy('id','desc')->update(['site_icon'=>null]);

                break;
            case 'logo':
                $img = CMS::orderBy('id','desc')->update(['logo'=>null]);

                break;
            case 'banner_bg_img':
                $img = CMS::orderBy('id','desc')->update(['banner_bg_img'=>null]);

                break;
            case 'banner_btn':
                $img = CMS::orderBy('id','desc')->update(['banner_btn'=>null]);

                break;
            case 'welcome_bg':
                $img = CMS::orderBy('id','desc')->update(['welcome_bg'=>null]);

                break;
            case 'welcome_btn':
                $img = CMS::orderBy('id','desc')->update(['welcome_btn'=>null]);

                break;
            case 'winner_bg':
                $img = CMS::orderBy('id','desc')->update(['winner_bg'=>null]);

                break;
            case 'winner_side_image':
                $img = CMS::orderBy('id','desc')->update(['winner_side_image'=>null]);

                break;
            case 'winner_btn':
                $img = CMS::orderBy('id','desc')->update(['winner_btn'=>null]);

                break;
            case 'promotion_bg':
                $img = CMS::orderBy('id','desc')->update(['promotion_bg'=>null]);

                break;
            case 'promotion_side_img':
                $img = CMS::orderBy('id','desc')->update(['promotion_side_img'=>null]);

                break;
            case 'promotion1_bg':
                $img = CMS::orderBy('id','desc')->update(['promotion1_bg'=>null]);

                break;
            case 'promotion1_icon1':
                $img = CMS::orderBy('id','desc')->update(['promotion1_icon1'=>null]);

                break;
            case 'promotion1_icon2':
                $img = CMS::orderBy('id','desc')->update(['promotion1_icon2'=>null]);

                break;
            case 'promotion1_icon3':
                $img = CMS::orderBy('id','desc')->update(['promotion1_icon3'=>null]);

                break;
            case 'promotion1_icon4':
                $img = CMS::orderBy('id','desc')->update(['promotion1_icon4'=>null]);

                break;
            case 'promotion1_icon5':
                $img = CMS::orderBy('id','desc')->update(['promotion1_icon5'=>null]);

                break;
            case 'top_footer_bg':
                $img = CMS::orderBy('id','desc')->update(['top_footer_bg'=>null]);

                break;
            case 'top_footer_icon1':
                $img = CMS::orderBy('id','desc')->update(['top_footer_icon1'=>null]);

                break;
            case 'top_footer_icon2':
                $img = CMS::orderBy('id','desc')->update(['top_footer_icon2'=>null]);

                break;
            case 'top_footer_icon3':
                $img = CMS::orderBy('id','desc')->update(['top_footer_icon3'=>null]);

                break;
            case 'footer_payment_icon1':
                $img = CMS::orderBy('id','desc')->update(['footer_payment_icon1'=>null]);

                break;
            case 'footer_payment_icon2':
                $img = CMS::orderBy('id','desc')->update(['footer_payment_icon2'=>null]);

                break;
            case 'footer_payment_icon3':
                $img = CMS::orderBy('id','desc')->update(['footer_payment_icon3'=>null]);

                break;
            case 'footer_payment_icon4':
                $img = CMS::orderBy('id','desc')->update(['footer_payment_icon4'=>null]);

                break;
            case 'client_img1':
                $img = CMS::orderBy('id','desc')->update(['client_img1'=>null]);

                break;
            case 'client_img2':
                $img = CMS::orderBy('id','desc')->update(['client_img2'=>null]);

                break;
            case 'client_img3':
                $img = CMS::orderBy('id','desc')->update(['client_img3'=>null]);

                break;
            case 'client_img4':
                $img = CMS::orderBy('id','desc')->update(['client_img4'=>null]);

                break;
            case 'client_img5':
                $img = CMS::orderBy('id','desc')->update(['client_img5'=>null]);

                break;
            case 'client_promo_icon1':
                $img = CMS::orderBy('id','desc')->update(['client_promo_icon1'=>null]);

                break;
            default:
              return redirect()->back();
                break;
        }
        return redirect()->back();
    }
}
