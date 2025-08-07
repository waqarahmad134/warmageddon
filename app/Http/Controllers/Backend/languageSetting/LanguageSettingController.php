<?php

namespace App\Http\Controllers\Backend\languageSetting;

use App\Language;
use App\LanguageKey;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
class LanguageSettingController extends Controller
{
     public function keys()
     {
         $lang_keys                    = LanguageKey::all();
         return view('backend.language-setting.keys.index',compact('lang_keys'));
     }
     public function add_key()
     {
         return view('backend.language-setting.keys.add');
     }
    public function edit_key($id)
    {
        $lang_key                    = LanguageKey::where('id',$id)->first();
        return view('backend.language-setting.keys.edit',compact('lang_key'));
    }
    public function save_key(Request $request)
    {
        $input                        = $request->all();
        $keys                         = explode(',',$input['key_name']);
        foreach ($keys as $key)
        {

            if ($key!=null && $key!="")
            {
                if (LanguageKey::where('key_name',$key)->exists()) {
                    Toastr::error($key.' key already exists in the database');
                    return redirect()->back();
                }
                else
                {
                    $langKey                      = new LanguageKey();
                    $langKey->key_name            = $key;
                    $langKey->status              = $input['key_status'];
                    $langKey->save();
                }

            }

        }

       Toastr::success('Language key has been added successfully');
        return redirect()->back();
    }
    public function update_key(Request $request)
    {
        $input                        = $request->all();
        $langKey                      = LanguageKey::where('id',$input['keyID'])->first();
        if ($input['key_name']!=$langKey->key_name && Validator::make($input, ['key_name' =>'unique:language_keys'])->fails()) {
            Toastr::error('key already exists in the database');
            return redirect()->back();
        }
        $langKey->key_name            = $input['key_name'];
        $langKey->status              = $input['key_status'];
        $langKey->save();
        Toastr::success('Language key has been updated successfully');
        return redirect()->route('language-settings.keys');
    }
    public function language()
    {
        $lang                       = Language::with('getlangkey')->get();
        return view('backend.language-setting.index',compact('lang'));
    }
    public function add_lang()
    {
        $lang_keys                     = LanguageKey::where('status',1)->get();
        return view('backend.language-setting.add',compact('lang_keys'));
    }
    public function edit_lang($id)
    {
        $lang                       = Language::where('id',$id)->with('getlangkey')->first();
        $lang_keys                     = LanguageKey::where('status',1)->get();
        return view('backend.language-setting.edit',compact('lang','lang_keys'));
    }
    public function delete_lang($id)
    {
        $lang                       = Language::where('id',$id);
        $lang->delete();
        Toastr::success('Language row has been deleted successfully');
        return redirect()->back();
    }
    public function save_lang(Request $request)
    {
        $input                      = $request->all();
        if (!empty($input['lang_key']) && is_array($input['lang_key']) && sizeof($input['lang_key']) > 0)
        {

            for ($i=0; $i < sizeof($input['lang_key']); $i++)
            {
             //echo $input['lang_key'][$i].'=>'.$input['lang_original_text'][$i].'=>'.$input['lang_translated_text'][$i].'=>'.$input['status'][$i].'<br>';
            if (!Language::where('lang_key',$input['lang_key'][$i])->where('lang_original_text', $input['lang_original_text'][$i])->exists())
            {
                $lang                       = new Language();
                $lang->lang                 = $input['lang'][$i];
                $lang->lang_key             = $input['lang_key'][$i];
                $lang->lang_original_text   = $input['lang_original_text'][$i];
                $lang->lang_translated_text = $input['lang_translated_text'][$i];
                $lang->status               = $input['status'][$i];
                $lang->save();
            }

            }
        }
        Toastr::success('Language rows has been added successfully');
        return redirect()->route('language-settings.index');
    }
    public function update_lang(Request $request)
    {
        $input                      = $request->all();
        $lang                       = Language::where('id',$input['langID'])->first();
        $lang->lang                 = $input['lang'];
        $lang->lang_key             = $input['lang_key'];
        $lang->lang_original_text   = $input['lang_original_text'];
        $lang->lang_translated_text = $input['lang_translated_text'];
        $lang->status               = $input['status'];
        $lang->save();
        Toastr::success('Language row has been added successfully');
        return redirect()->route('language-settings.index');
    }
}
