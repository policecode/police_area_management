<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OptionAutoload;
use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $option = SettingHelpers::getInstance();
        $dataView = array(
            'page_title' => 'Cài đặt trang web',
            'options' => $option->get(['fvn_shortcut_icon', 'fvn_logo', 'fvn_content_top', 'fvn_content_bottom', 'fvn_web_title', 'fvn_telegram_link', 'fvn_facebook_link', 'fvn_tiktok_link', 'fvn_discord_link', 'fvn_instagram_link', 'fvn_twitter_link'])
        );
        return view('admin_page.settings.lists', $dataView);
    }

    public function affiliate()
    {
        $option = SettingHelpers::getInstance();
        $result = $option->get(['affiliate_in_chapter']);
        // $option->templateOptionDB();
        $dataView = array(
            'page_title' => 'Cài đặt quảng cáo trên trang web',
            'options' => $result
        );
        // dd($result);
        return view('admin_page.settings.list_affiliate', $dataView);
    }

    public function settingPageOne(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->rules($request), $this->messages(), $this->attributes());
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }
            DB::beginTransaction();

            if ($request->hasFile('fvn_shortcut_icon')) {
                $image = $request->file('fvn_shortcut_icon')->store('stories/settings');
                $result = Option::getByOptionKey('fvn_shortcut_icon')->first();
                if ($result) {
                    Storage::delete($result->option_value);
                    $result->option_value = $image;
                    $result->save();
                } else {
                    Option::create([
                        'option_key' => 'fvn_shortcut_icon',
                        'option_value' => $image,
                        'autoload' => OptionAutoload::YES['key']
                    ]);
                }
            }
            if ($request->hasFile('fvn_logo')) {
                $image = $request->file('fvn_logo')->store('stories/settings');
                $result = Option::getByOptionKey('fvn_logo')->first();
                if ($result) {
                    Storage::delete($result->option_value);
                    $result->option_value = $image;
                    $result->save();
                } else {
                    Option::create([
                        'option_key' => 'fvn_logo',
                        'option_value' => $image,
                        'autoload' => OptionAutoload::YES['key']
                    ]);
                }
            }

            $data = $validator->validated();

            foreach ($data as $key => $value) {
                if (!trim($value)) {
                    continue;
                }
                $result = Option::getByOptionKey($key)->first();
                if ($result) {
                    $result->option_value = $value;
                    $result->save();
                } else {
                    Option::create([
                        'option_key' => $key,
                        'option_value' => $value,
                        'autoload' => OptionAutoload::YES['key']
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => [],
                'message' => 'Update success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function settingPageAffiliate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), ['affiliate_in_chapter' => ''], $this->messages(), $this->attributes());
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }
            DB::beginTransaction();

            if ($request->hasFile('fvn_shortcut_icon')) {
                $image = $request->file('fvn_shortcut_icon')->store('stories/settings');
                $result = Option::getByOptionKey('fvn_shortcut_icon')->first();
                if ($result) {
                    Storage::delete($result->option_value);
                    $result->option_value = $image;
                    $result->save();
                } else {
                    Option::create([
                        'option_key' => 'fvn_shortcut_icon',
                        'option_value' => $image,
                        'autoload' => OptionAutoload::YES['key']
                    ]);
                }
            }
            if ($request->hasFile('fvn_logo')) {
                $image = $request->file('fvn_logo')->store('stories/settings');
                $result = Option::getByOptionKey('fvn_logo')->first();
                if ($result) {
                    Storage::delete($result->option_value);
                    $result->option_value = $image;
                    $result->save();
                } else {
                    Option::create([
                        'option_key' => 'fvn_logo',
                        'option_value' => $image,
                        'autoload' => OptionAutoload::YES['key']
                    ]);
                }
            }

            $data = $validator->validated();

            foreach ($data as $key => $value) {
                if (!trim($value)) {
                    continue;
                }
                $result = Option::getByOptionKey($key)->first();
                if ($result) {
                    $result->option_value = $value;
                    $result->save();
                } else {
                    Option::create([
                        'option_key' => $key,
                        'option_value' => $value,
                        'autoload' => OptionAutoload::YES['key']
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => [],
                'message' => 'Update success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    private function rules($request)
    {
        $rules = [
            'fvn_content_bottom' => '',
            'fvn_content_top' => '',
            'fvn_web_title' => '',
            'fvn_telegram_link' => '',
            'fvn_facebook_link' => '',
            'fvn_tiktok_link' => '',
            'fvn_discord_link' => '',
            'fvn_instagram_link' => '',
            'fvn_twitter_link' => '',
        ];

        return $rules;
    }

    private function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute phải từ :min ký tự',
            'integer' => ':attribute phải là số'
        ];
    }

    private function attributes()
    {
        return [
            'title' => 'Tên truyện',
            'slug' => 'Đường dẫn tĩnh',
            'email' => 'Email',
            'password' => 'Mật khâu',
            'group_id' => 'Nhóm',
            'author_id' => 'Tác giả',
            'status' => 'Trạng thái truyện',
            'description' => 'Thông tin về truyện'
        ];
    }
}
