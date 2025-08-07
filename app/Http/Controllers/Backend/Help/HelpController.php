<?php

namespace App\Http\Controllers\Backend\Help;

use App\FAQ;
use App\FAQMedia;
use App\HelpCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelpController extends Controller
{
    public function category()
    {
        $categories                   = HelpCategory::all();
        return view('backend.help.categories.index',compact('categories'));
    }
    public function save_category(Request $request)
    {
        $input                         = $request->all();
        $faq_cat                       = new HelpCategory();
        $faq_cat->name                 = $input['category_name'];
        $faq_cat->order_no             = $input['order_no'];
        $faq_cat->status               = $input['category_status'];
        $faq_cat->save();
        Toastr::success('FAQ category has been added successfully');
        return redirect()->back();
    }
    public function edit_category($id)
    {
        $category                      = HelpCategory::findorfail($id);
        return view('backend.help.categories.edit',compact('category'));
    }
    public function update_category(Request $request)
    {
        $input                         = $request->all();
        $faq_cat                       = HelpCategory::where('id',$input['catID'])->first();
        $faq_cat->name                 = $input['category_name'];
        $faq_cat->order_no              = $input['order_no'];
        $faq_cat->status               = $input['category_status'];
        $faq_cat->save();
        Toastr::success('FAQ category has been updated successfully');
        return redirect('dash-panel/faq-categories');
    }

    // Faq list
    public function index()
    {
        $faqs                      = FAQ::with('media','category')->orderBy('order_no','asc')->get();
        return view('backend.help.index',compact('faqs'));
    }
    public function add()
    {
        $categories                   = HelpCategory::where('status',1)->get();
        return view('backend.help.add',compact('categories'));
    }
    public function save(Request $request)
    {
        $input                        = $request->all();
        DB::beginTransaction();
        $faq                          = new FAQ();
        $faq->category                = $input['category'];
        $faq->question                = $input['question'];
        $faq->answer                  = $input['answer'];
        $faq->order_no                = $input['order'];
        $faq->status                  = $input['status'];
        $faq->save();
        if($request->file('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $name = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' . $file->getClientOriginalName();
                $destinationPath = base_path('/backend/faq/media/');
                $destination = $file->move($destinationPath, $name);
                DB::table('faq_media')->insert([
                    'category_id' => $input['category'],
                    'faq_id'    => $faq->id,
                    'src'    => $name,
                ]);
            }
        }
        DB::commit();
        Toastr::success('FAQ has been added successfully');
        return redirect()->back();

    }
    public function edit($id)
    {
        $faq                          = FAQ::where('id',$id)->with('category','media')->first();
        $categories                   = HelpCategory::where('status',1)->get();
        return view('backend.help.edit',compact('faq','categories'));
    }
    public function update(Request $request)
    {
        $input                        = $request->all();
        DB::beginTransaction();
        $faq                          = FAQ::where('id',$input['faqID'])->first();
        $faq->category                = $input['category'];
        $faq->question                = $input['question'];
        $faq->answer                  = $input['answer'];
        $faq->order_no                = $input['order_no'];
        $faq->status                  = $input['status'];
        $faq->save();
        if($request->file('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $name =  (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.'.$file->getClientOriginalName();
                $destinationPath = base_path('/backend/faq/media/');
                $destination = $file->move($destinationPath, $name);
                DB::table('faq_media')->insert([
                    'category_id' => $input['category'],
                    'faq_id'    => $faq->id,
                    'src'    => $name,
                ]);
            }
        }
        DB::commit();
        Toastr::success('FAQ has been updated successfully');
        return redirect()->back();
    }
    public function delete_media($id)
    {
        $media                     = FAQMedia::findorfail($id);
        $media->delete();
        Toastr::success('FAQ media file has been deleted successfully');
        return redirect()->back();
    }
}
