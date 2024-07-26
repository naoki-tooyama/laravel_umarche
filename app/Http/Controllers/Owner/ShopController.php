<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ShopController extends Controller
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
            // dd($request->route()->parameter('shop'));//文字列：URL
            // dd(Auth::id());//数字：ログインID

            $id = $request->route()->parameter('shop');//shopのid取得
            if(!is_null($id)){
                $shopsOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId  = (int)$shopsOwnerId;//キャスト　文字列→数値変換
                $ownerId = Auth::id();
                if($shopId !== $ownerId){//一致しなかったら
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
        // phpinfo();

        // $ownerId = Auth::id();//ログインしているオーナのIDを取得
        $shops = Shop::where('owner_id', Auth::id())->get();

        return view('owner.shops.index',
        compact('shops'));
    }

    public function edit($id) {
        // dd(shop::findOrfail($id));
        $shop= Shop::findOrFail($id);
        return view('owner.shops.edit', compact('shop'));
    }

    public function update(Request $request, $id){
        $imageFile = $request->image;
        if(!is_null($imageFile) && $imageFile->isValid() ){
            // Storage::putFile('public/shops', $imageFile);//リサイズなしの場合

            // dd(storage_path('public\shops'. $imageFile));
            
            $fileName = uniqid(rand().'_');
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName.'.'.$extension;
            // dd('public/shops/'.$fileNameToStore);

            //画像のリサイズ
            $manager = new ImageManager(new Driver());
            $resizedImage = $manager->read($imageFile);
            $resizedImage = $resizedImage->resize(1920,1080)->encode();
    
            Storage::put('public/shops/'.$fileNameToStore, $resizedImage);
        }

        return redirect()->route('owner.shops.index');
    }
}
