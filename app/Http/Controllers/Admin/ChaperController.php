<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Chaper;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Str;
use ZipArchive;

class ChaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Story $story)
    {
        $dataView = array(
            'page_title' => 'Quản lý chương truyện',
            'story' => $story
        );
        return view('admin_page.stories.lists_chaper', $dataView);
    }

    public function getItems(Request $request)
    {
        // Thêm dữ liệu vào trong query
        // $request->merge(array_merge($queryDefault, $request->query()));

        try {
            $query = Chaper::filter($request);
            $res = [
                'result' => 1,
                'data' => [],
                'page' => $query->getPageNumber(),
                'per_page' => $query->getPerPage(),
                'total' => 0
            ];
            if ($request->is_paginate) {
                $res['total'] = $query->getTotal();
            } else {
                $res['data']  = $query->get();
            }
            return response()->json($res);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0,
                'data' => [],
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Story $story)
    {
        try {
            $validator = Validator::make($request->all(), $this->rules($request, $story), $this->messages(), $this->attributes());
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }

            DB::beginTransaction();
            $data = $validator->validated();
            $user = Auth::user();
            $chaper = Chaper::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'slug' => $data['slug'],
                'story_id' => $story->id,
                'content' => $data['content'],
                'content_length' => count(explode(" ", $data['content'])),
                'position' => $data['position'],
                'money' => $data['money']
            ]);
            $total_chapter = $story->total_chapter + 1;
            $story->update([
                'last_chapers' => Carbon::now(),
                'chaper_id' => $chaper->id,
                'total_chapter' => $total_chapter
            ]);

            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => $chaper,
                'message' => 'Create success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showListChapter($story)
    {
        if (!env('DOWNLOAD_STORY')) {
            return response()->json([
                'result' => 0,
                'message' => 'Không Cho phép sử dụng tính năng này'
            ]);
        }
        try {
            $data = Chaper::SelectNotContent()->getByStory($story)->orderBy('position', 'ASC')->get();
            return response()->json([
                'result' => 1,
                'data' => $data,
                'total' => $data->count()
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0,
                'data' => [],
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function showDetailChapter($story, $position)
    {
        if (!env('DOWNLOAD_STORY')) {
            return response()->json([
                'result' => 0,
                'message' => 'Không Cho phép sử dụng tính năng này'
            ]);
        }
        try {
            $chaper = Chaper::GetByStory($story)->GetByPosition($position)->first();
            return response()->json([
                'status' => 1,
                'data' => $chaper,
                'message' => 'Get success'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0,
                'data' => [],
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $story, Chaper $chaper)
    {
        try {
            $validator = Validator::make($request->all(), $this->rules($request, $story), $this->messages(), $this->attributes());
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }

            DB::beginTransaction();
            $data = $validator->validated();
            $data['content_length'] = count(explode(" ", $data['content']));
            $chaper->update($data);

            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => $chaper,
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

    public function positionPlus(Request $request, $story, $position)
    {
        try {


            DB::beginTransaction();
            Chaper::GetByStory($story)->where('position', '>=', $position)->increment('position');

            DB::commit();
            return response()->json([
                'status' => 1,
                'message' => 'Update position success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story, Chaper $chaper)
    {
        try {
            DB::beginTransaction();
            $status = $chaper->delete();
            if ($status) {
                $total_chapter = $story->total_chapter - 1;
                $story->update([
                    'chaper_id' => Chaper::getByStory($story->id)->orderBy('position', 'DESC')->first()->id,
                    'total_chapter' => $total_chapter
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => $status,
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroyAll(Request $request, Story $story)
    {
        try {
            $condition = $request->all();
            DB::beginTransaction();
            // $storyColection = Story::find($story->id);
            $deleteQuery = Chaper::getByStory($story->id);
            if ($condition['start'] > 0) {
                $deleteQuery->where('position', '>=', $condition['start']);
            }
            if ($condition['end'] > 0) {
                $deleteQuery->where('position', '<=', $condition['end']);
            }
            $status = $deleteQuery->delete();
            $story->update([
                'last_chapers' => NULL,
                'chaper_id' => NULL,
                'total_chapter' => 0
            ]);
            DB::commit();
            return response()->json([
                'status' => $status,
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function autoConvertFreeFullChapter(Request $request, $story)
    {
        try {
            $listStory = Chaper::GetByStory($story)->GetByMoney()->get();
            $incrent = 0;
            foreach ($listStory as $key => $chapter) {
                $chapter->money = 0;
                $chapter->update();
                $incrent++;
            }
            return response()->json([
                'message' => 'Hạ giá: ' . $incrent . ' chương xuống 0 đồng',
                'status' => 1,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 0,
            ]);
        }
    }

    private function rules($request, $story_id)
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'content' => '',
            'money' => '',

        ];
        if ($request->id) {
            $rules['position'] = ['required', 'integer', function ($attr, $value, $fail) use ($request, $story_id) {
                $chaper = Chaper::getByStory($story_id)->getByPosition($value)->where('id', '!=', $request->id)->first();
                if ($chaper) {
                    $fail('Vị trí này đã được sử dụng');
                }
            }];
        } else {
            $rules['position'] = ['required', 'integer', function ($attr, $value, $fail) use ($story_id) {
                $chaper = Chaper::getByStory($story_id)->getByPosition($value)->first();
                if ($chaper) {
                    $fail('Vị trí này đã được sử dụng');
                }
            }];
        }
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
            'name' => 'Thông tin chương truyện',
            'slug' => 'Đường dẫn tĩnh',
            'email' => 'Email',
            'author_id' => 'Tác giả',
            'position' => 'Vị trí chương truyện',
            'content' => 'Nội dung chương truyện'
        ];
    }

    public function uploadChapterByWord(Request $request, Story $story)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            if ($request->hasFile('fvn_list_word')) {
                $files = $request->file('fvn_list_word');
                $data = [];
                $dataInsert = [];
                $listPosition = [];
                foreach ($files as $key => $file) {
                    $position = (int) explode('.', $file->getClientOriginalName())[0];
                    $listPosition[] = $position;
                    $tmpPath = $file->getPathname();
                    $resultArr = $this->readFileWord($tmpPath);
                    $money = 0;
                    if (($story->buy_money > 0) && $story->buy_position && ($position >= $story->buy_position)) {
                        $money = $story->buy_money;
                    }

                    $data[] = array_merge([
                        'position' => $position,
                        'user_id' => $user->id,
                        'story_id' => $story->id,
                        'money' => $money,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ], $resultArr);
                }


                $resultChapers = Chaper::getByStory($story->id)->whereIn('position', $listPosition)->get();
                foreach ($data as $key => $chapter) {
                    $flag = true;
                    if (count($resultChapers) > 0) {
                        foreach ($resultChapers as $k => $obj) {
                            if ($obj->position == $chapter['position']) {
                                $flag = false;
                            }
                        }
                    }
                    # code...
                    if ($flag) {
                        $dataInsert[] = $chapter;
                    }
                }
                if (count($dataInsert) > 0) {
                    $result = Chaper::insert($dataInsert);
                    $last_record = Chaper::orderBy('id', 'DESC')->first();
                    if ($story->total_chapter) {
                        $total_chapter = $story->total_chapter + count($dataInsert);
                    } else {
                        $total_chapter = count($dataInsert);
                    }
                    $story->last_chapers = Carbon::now();
                    $story->chaper_id = $last_record->id;
                    $story->total_chapter = $total_chapter;
                    $story->update();
                }
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'data' => [],
                    'message' => 'Add ' . count($dataInsert) . ' Chapter'
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function renderFileEpub(Request $request, Story $story)
    {
        ini_set('max_execution_time', 300);

        try {
            $fileName = 'truyen_epub_' . $story->id . '.epub';
            $filePath = storage_path('app/public/' . $fileName);

            $zip = new ZipArchive();
            if ($zip->open($filePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
                throw new \Exception("Không thể tạo file EPUB tại đường dẫn này.");
            }

            // 1. File mimetype bắt buộc đứng đầu và không nén
            $zip->addFromString('mimetype', 'application/epub+zip');
            $zip->setCompressionName('mimetype', ZipArchive::CM_STORE);

            // 2. META-INF/container.xml
            $containerXml = '<?xml version="1.0" encoding="UTF-8"?>
<container version="1.0" xmlns="urn:oasis:names:tc:opendocument:xmlns:container">
    <rootfiles>
        <rootfile full-path="OEBPS/content.opf" media-type="application/oebps-package+xml"/>
    </rootfiles>
</container>';
            $zip->addFromString('META-INF/container.xml', $containerXml);

            // --- XỬ LÝ ẢNH BÌA ĐA ĐỊNH DẠNG ---
            $hasCover = false;
            $coverExtension = 'jpg';
            $coverMimeType = 'image/jpeg';
            $coverManifestItem = '';
            $coverSpineItem = '';
            $metaCoverTag = '';

            // Lấy đường dẫn ảnh từ cột thumbnail
            $coverField = $story->thumbnail ?? null;

            if ($coverField) {
                $localPath = public_path($coverField);
                if (!file_exists($localPath)) {
                    $localPath = storage_path('app/public/' . $coverField);
                }
                if (!file_exists($localPath)) {
                    $localPath = storage_path('app/' . $coverField);
                }

                if (file_exists($localPath)) {
                    $coverContentData = file_get_contents($localPath);
                    $ext = strtolower(pathinfo($localPath, PATHINFO_EXTENSION));

                    $mimeTypes = [
                        'jpg'  => 'image/jpeg',
                        'jpeg' => 'image/jpeg',
                        'png'  => 'image/png',
                        'webp' => 'image/webp',
                        'gif'  => 'image/gif',
                        'bmp'  => 'image/bmp'
                    ];

                    if (array_key_exists($ext, $mimeTypes)) {
                        $coverExtension = $ext;
                        $coverMimeType = $mimeTypes[$ext];
                    }

                    $zip->addFromString('OEBPS/cover.' . $coverExtension, $coverContentData);
                    $hasCover = true;

                    $coverPageHtml = '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Ảnh bìa</title>
    <style>body { margin: 0; padding: 0; text-align: center; background-color: #fff; }</style>
</head>
<body>
    <div>
        <img src="cover.' . $coverExtension . '" alt="Cover" style="max-width: 100%; height: auto;" />
    </div>
</body>
</html>';
                    $zip->addFromString('OEBPS/cover.xhtml', $coverPageHtml);

                    // Khai báo chuẩn cho manifest và spine của ảnh bìa
                    $coverManifestItem = '    <item id="cover-image" href="cover.' . $coverExtension . '" media-type="' . $coverMimeType . '"/>' . "\n" .
                        '    <item id="cover-page" href="cover.xhtml" media-type="application/xhtml+xml"/>' . "\n";
                    $coverSpineItem = '    <itemref idref="cover-page"/>' . "\n";
                    $metaCoverTag = '    <meta name="cover" content="cover-image"/>' . "\n";
                }
            }
            // ------------------------------------

            // Lấy thông tin tác giả
            $author = $story->author_id ? Author::find($story->author_id) : null;
            $authorName = $author ? $author->name : 'Đang cập nhật';

            $storyTitle = htmlspecialchars($story->title ?? $story->name ?? 'Truyện', ENT_QUOTES, 'UTF-8');

            // Xử lý chuyển đổi các thẻ <br> thành xuống dòng cho phần Giới thiệu
            $rawDescription = $story->description ?? '';
            $cleanDescription = html_entity_decode($rawDescription);
            $cleanDescription = preg_replace('/<br\s*[\/]?>/i', "\n", $cleanDescription);
            $storyDescription = nl2br(htmlspecialchars($cleanDescription, ENT_QUOTES, 'UTF-8'));

            // 3. Tạo trang Giới thiệu truyện (intro.xhtml)
            $introPageHtml = '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Giới thiệu truyện</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div class="intro-container" style="text-align: center; margin-top: 20px;">
        <h1>' . $storyTitle . '</h1>
        <h3>Tác giả: ' . htmlspecialchars($authorName, ENT_QUOTES, 'UTF-8') . '</h3>
        <h3>Website: ' . env('APP_URL') . '</h3>
        <hr style="width: 50%; margin: 20px auto;"/>
    </div>
    <div class="description-container" style="text-align: left; padding: 0 10px;">
        <h4>Giới thiệu:</h4>
        <div>' . $storyDescription . '</div>
    </div>
</body>
</html>';
            $zip->addFromString('OEBPS/intro.xhtml', $introPageHtml);

            // Lấy danh sách chương bằng cursor để tối ưu RAM cho truyện 1000+ chương
            $chapers = Chaper::getByStory($story->id)
                ->select('position', 'name', 'content')
                ->orderBy('position', 'ASC')
                ->cursor();

            $manifestItems = '';
            $spineItems = '';
            $ncxNavPoints = '';
            $htmlNavList = '';
            $playOrderCount = 1;

            // Thêm mục Ảnh bìa vào mục lục NCX (nếu có)
            if ($hasCover) {
                $ncxNavPoints  .= '    <navPoint id="nav_cover" playOrder="' . $playOrderCount++ . '">
        <navLabel><text>Ảnh bìa</text></navLabel>
        <content src="cover.xhtml"/>
    </navPoint>' . "\n";
            }

            // Thêm mục Giới thiệu vào mục lục NCX
            $ncxNavPoints  .= '    <navPoint id="nav_intro" playOrder="' . $playOrderCount++ . '">
        <navLabel><text>Giới thiệu truyện</text></navLabel>
        <content src="intro.xhtml"/>
    </navPoint>' . "\n";

            // Thêm mục Mục lục vào sau Giới thiệu trong NCX
            $ncxNavPoints  .= '    <navPoint id="nav_toc_page" playOrder="' . $playOrderCount++ . '">
        <navLabel><text>Mục Lục</text></navLabel>
        <content src="toc.xhtml"/>
    </navPoint>' . "\n";

            // 4. Duyệt qua từng chương để tạo file xhtml riêng biệt
            foreach ($chapers as $chaper) {
                $id = 'chapter_' . $chaper->position;
                $fileNameXhtml = $id . '.xhtml';

                $chapterTitle = htmlspecialchars($chaper->name, ENT_QUOTES, 'UTF-8');

                $rawChapterContent = $chaper->content ?? '';
                $cleanChapterContent = preg_replace('/<\s*br\s*[\/]?>/i', "\n", $rawChapterContent);
                $cleanChapterContent = preg_replace('/<\/\s*[a-zA-Z0-9]+\s*>/i', "\n", $cleanChapterContent);
                $cleanChapterContent = preg_replace('/<[a-zA-Z0-9]+(\s+[^>]*)?>/i', '', $cleanChapterContent);
                $cleanChapterContent = html_entity_decode($cleanChapterContent);
                $chapterContent = nl2br(htmlspecialchars(strip_tags($cleanChapterContent), ENT_QUOTES, 'UTF-8'));

                $xhtmlContent = '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>' . $chapterTitle . '</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div class="chapter-container">
        <h1>' . $chapterTitle . '</h1>
        <div class="content">' . $chapterContent . '</div>
    </div>
</body>
</html>';

                $zip->addFromString('OEBPS/' . $fileNameXhtml, $xhtmlContent);

                $manifestItems .= '    <item id="' . $id . '" href="' . $fileNameXhtml . '" media-type="application/xhtml+xml"/>' . "\n";
                $spineItems    .= '    <itemref idref="' . $id . '"/>' . "\n";

                $ncxNavPoints  .= '    <navPoint id="nav_' . $chaper->position . '" playOrder="' . $playOrderCount++ . '">
        <navLabel><text>' . $chapterTitle . '</text></navLabel>
        <content src="' . $fileNameXhtml . '"/>
    </navPoint>' . "\n";

                $htmlNavList   .= '        <li><a href="' . $fileNameXhtml . '">' . $chapterTitle . '</a></li>' . "\n";
            }

            // 5. Tạo file CSS cơ bản
            $cssContent = 'body { font-family: sans-serif; margin: 5%; line-height: 1.6; } h1 { font-size: 1.3em; text-align: center; color: #333; }';
            $zip->addFromString('OEBPS/style.css', $cssContent);

            // 6. Tạo trang Mục lục HTML hiển thị
            $tocPageHtml = '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Mục Lục</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <h1>Mục Lục Truyện</h1>
    <ul style="list-style-type: none; padding: 0;">
' . $htmlNavList . '
    </ul>
</body>
</html>';
            $zip->addFromString('OEBPS/toc.xhtml', $tocPageHtml);

            // Đưa ảnh bìa, intro, toc vào manifest và sắp xếp thứ tự hiển thị (spine) lên đầu sách
            $manifestItems = ($hasCover ? $coverManifestItem : '') .
                '    <item id="intro" href="intro.xhtml" media-type="application/xhtml+xml"/>' . "\n" .
                '    <item id="toc_page" href="toc.xhtml" media-type="application/xhtml+xml"/>' . "\n" .
                $manifestItems;

            $spineItems = ($hasCover ? $coverSpineItem : '') .
                '    <itemref idref="intro"/>' . "\n" .
                '    <itemref idref="toc_page"/>' . "\n" .
                $spineItems;

            // 7. Tạo file điều hướng toc.ncx chuẩn
            $tocNcx = '<?xml version="1.0" encoding="UTF-8"?>
<ncx xmlns="http://www.daisy.org/z3986/2005/ncx/" version="2005-1">
    <head>
        <meta name="dtb:uid" content="urn:uuid:story-' . $story->id . '"/>
        <meta name="dtb:depth" content="1"/>
        <meta name="dtb:totalPageCount" content="0"/>
        <meta name="dtb:maxPageNumber" content="0"/>
    </head>
    <docTitle><text>' . $storyTitle . '</text></docTitle>
    <navMap>
' . $ncxNavPoints . '
    </navMap>
</ncx>';
            $zip->addFromString('OEBPS/toc.ncx', $tocNcx);

            // 8. Tạo file gói dữ liệu content.opf (Đã gắn thêm $metaCoverTag và $manifestItems đầy đủ)
            $contentOpf = '<?xml version="1.0" encoding="utf-8"?>
<package xmlns="http://www.idpf.org/2007/opf" unique-id="BookId" version="2.0">
    <metadata xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:opf="http://www.idpf.org/2007/opf">
        <dc:title>' . $storyTitle . '</dc:title>
        <dc:creator opf:role="aut">' . htmlspecialchars($authorName, ENT_QUOTES, 'UTF-8') . '</dc:creator>
        <dc:language>vi</dc:language>
        <dc:identifier id="BookId" opf:scheme="UUID">urn:uuid:story-' . $story->id . '</dc:identifier>
' . $metaCoverTag . '    </metadata>
    <manifest>
        <item id="ncx" href="toc.ncx" media-type="application/x-dtbncx+xml"/>
        <item id="style" href="style.css" media-type="text/css"/>
' . $manifestItems . '
    </manifest>
    <spine toc="ncx">
' . $spineItems . '
    </spine>
</package>';
            $zip->addFromString('OEBPS/content.opf', $contentOpf);

            $zip->close();

            return response()->json([
                'status' => 1,
                'message' => 'File EPUB with Cover, Intro & TOC created successfully',
                'file_path' => Storage::url($fileName)
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    private function readFileWord($pathFile)
    {
        $arrStr = [];
        // Đọc file .docx
        $phpWord = IOFactory::load($pathFile);
        // Lấy tất cả các section trong tài liệu
        $sections = $phpWord->getSections();

        // Duyệt qua từng section để lấy nội dung
        foreach ($sections as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                // Kiểm tra xem phần tử có phải là text run không
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    // Lấy các phần tử con của text run
                    $textElements = $element->getElements();
                    $str = '';
                    foreach ($textElements as $textElement) {
                        if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                            $str = $str . $textElement->getText() . " ";
                        }
                    }
                    $arrStr[] = $str . '<br/>';
                } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                    $arrStr[] = $element->getText() . '<br/>';
                } elseif ($element instanceof \PhpOffice\PhpWord\Element\Title) {
                    $textElement = $element->getText();
                    if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                        $arrStr[] = $textElement->getText();
                    } elseif ($textElement instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        $textChildElements = $textElement->getElements();
                        $str = '';
                        foreach ($textChildElements as $textChildElement) {
                            if ($textChildElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                $str = $str . $textChildElement->getText() . " ";
                            }
                        }
                        $arrStr[] = $str;
                    } else {
                        $arrStr[] = $textElement;
                    }
                }
            }
        }
        $title = $arrStr[0];
        $title = str_replace('<br/>', '', $title);
        $title = str_replace('&quot;', '', $title);
        return [
            'name' => $title,
            'slug' => Str::slug($title, "-"),
            'content' => implode('<br/>', $arrStr)
        ];
    }
}
