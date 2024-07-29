<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;



class ImageController extends Controller
{
        /**
     * 新しいUserControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('image');//shopのid取得
            if(!is_null($id)){
                $imagesOwnerId = Image::findOrFail($id)->owner->id;
                $imageId = (int)$imagesOwnerId;//キャスト　文字列→数値変換
                if($imageId !== Auth::id()){//一致しなかったら
                    abort(404);//404画面表示
                }
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::where('owner_id', Auth::id())
                ->orderBy('updated_at', 'desc')// 降順（小さい順）
                ->paginate(20);

                return view('owner.images.index',
                compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        // dd($request);
        $imageFiles = $request->file('files');//配列で取得
        if( !is_null($imageFiles) ){
            foreach( $imageFiles as $imageFile ){//単数で処理
                $fileNameToStore = ImageService::upload($imageFile, 'products');
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameToStore
                ]);
            }
        }
        return redirect()
        ->route('owner.images.index')
        ->with(['message'=> '画像登録を実施しました。',
                'status' => 'info']);
        // $request->validate([
        //     'name' => ['required', 'string', 'max:50'],
        //     'information' => ['required', 'string', 'max:1000'],
        //     'is_selling' => ['required'],
        // ]);

        // $imageFile = $request->image;
        // if(!is_null($imageFile) && $imageFile->isValid() ){
        //     $fileNameToStore = ImageService::upload($imageFile, 'shops');
        // }

        // $shop = Shop::findOrFail($id);
        // $shop->name = $request->name;
        // $shop->information = $request->information;
        // $shop->is_selling = $request->is_selling;

        // if(!is_null($imageFile) && $imageFile->isValid()){
        //     $shop->filename = $fileNameToStore;
        // }
        // $shop->save();

        return redirect()
                ->route('owner.shops.index')
                ->with(['message'=> '店舗情報を更新しました。',
                        'status' => 'info']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image= Image::findOrFail($id);
        return view('owner.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['string', 'max:50'],
        ]);

        $image = Image::findOrFail($id);
        $image->title = $request->title;
        $image->save();

        return redirect()
                ->route('owner.images.index')
                ->with(['message'=> '画像情報を更新しました。',
                        'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $filePath = 'public/products/'.$image->filename;
        // dd($filePath,$image);
        if(Storage::exists($filePath)){
            Storage::delete($filePath);
        }

        Image::findOrFail($id)->delete();

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像を削除しました。',
            'status' => 'alert']);
    }
}
