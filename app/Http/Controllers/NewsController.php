<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\News;
use App\News_lang;
use App\Gallery_Image;
use App\Gallery_Video;
use Image;

class NewsController extends Controller
{
    //
    public function CategoryHome()
    {
        if(Auth::check()){
                $category=DB::table('category')->where('status',1)->get();
                return view('admin.news.category',['category'=>$category]);

        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function CategorySave(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $title_vi=$request->txtname;
                $title_en=$request->txtname_en;
                $category=Category::find($id);
                $category->title=$title_vi;
                $category->title_en=$title_en;
                if($request->hasFile('file'.$id)){
                    unlink("images/category/".$category->image);
                    $image = $request->file('file'.$id);
                    $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                    $path = public_path('images/category/' . $filename);
                    Image::make($image->getRealPath())->resize(300, 200)->save($path);
                    $category->image=$filename;
                }
                if($category->save())
                {
                    return redirect('admin/category-home')->with('thongbao','Cập nhật thành công!');
                }
                else{
                    return redirect('admin/category-home')->with('thatbai','Cập nhật không thành công!');
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/category-home')->with('thatbai','Cập nhật không thành công!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }

    public function NewsHome()
    {
        if(Auth::check()){

                $news=DB::table('news')
                    ->join('category','category.id','=','news.id_category')
                    ->join('news_lang','news.id','=','news_lang.new_id')
                    ->where('news.status',1)
                    ->where('news.id_category',1)
                    ->where('news_lang.lang','vi')
                    ->orderBy('updated_at','desc')
                    ->select('category.title as category','news.id','news.image','news_lang.title')
                    ->get();
                return view('admin.news.news',['news'=>$news]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function NewsGalleryHome()
    {
        if(Auth::check()){

            $news=DB::table('news')
                ->join('category','category.id','=','news.id_category')
                ->join('news_lang','news.id','=','news_lang.new_id')
                ->where('news.status',1)
                ->where('news.id_category',2)
                ->where('news_lang.lang','vi')
                ->orderBy('updated_at','desc')
                ->select('category.title as category','news.id','news.image','news_lang.title')
                ->get();
            return view('admin.news.news_gallery',['news'=>$news]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function GetNews($id)
    {
        if(Auth::check()){
            try{
                $news=News::find($id);
                $news_lang=News_lang::where('new_id',$id)->get();
                return view('admin.news.insert_news',['news'=>$news,'news_lang'=>$news_lang]);
            }
            catch (\Exception $e)
            {
                return redirect('admin/news-home')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function GetNewsGallery($id)
    {
        if(Auth::check()){
            try{
                $news=News::find($id);
                $news_lang=News_lang::where('new_id',$id)->get();
                return view('admin.news.insert_news_gallery',['news'=>$news,'news_lang'=>$news_lang]);
            }
            catch (\Exception $e)
            {
                return redirect('admin/news-gallery-home')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function SaveNews(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $title_vi=$request->title_vi;
                $title_en=$request->title_en;
                $content_vi=$request->content_vi;
                $content_en=$request->content_en;
                $keyword=$request->keyword;
                $description=$request->description;
                $author=$request->author;
                $is_form = $request->has('txtform') ? 1 : 0;
                if($id==0)
                {
                    $news=new News;
                    $news->id_category=1;
                    $news->status=1;
                    $news->slug=str_slug($title_vi);
                    $news->seo_keyword=$keyword;
                    $news->seo_description=$description;
                    $news->seo_author=$author;
                    $news->is_form=$is_form;
                    if($request->hasFile('file')){
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/news/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $news->image=$filename;
                    }
                    if($news->save())
                    {
                        $news_vi=new News_lang;
                        $news_vi->new_id=$news->id;
                        $news_vi->lang='vi';
                        $news_vi->title=$title_vi;
                        $news_vi->content=$content_vi;

                        $news_en=new News_lang;
                        $news_en->new_id=$news->id;
                        $news_en->lang='en';
                        $news_en->title=$title_en;
                        $news_en->content=$content_en;

                        $news_vi->save();
                        $news_en->save();
                        return redirect('admin/news-home')->with('thongbao','Thêm tin tức thành công!');
                    }
                    else{
                        return redirect('admin/news-home')->with('thatbai','Thêm tin tức thất bại!');
                    }
                }
                else{
                    $news=News::find($id);
                    $news->slug=str_slug($title_vi);
                    $news->seo_keyword=$keyword;
                    $news->seo_description=$description;
                    $news->seo_author=$author;
                    $news->is_form=$is_form;
                    if($request->hasFile('file')){
                        unlink('images/news/'.$news->image);
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/news/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $news->image=$filename;
                    }
                    if($news->save())
                    {
                        $news_vi=News_lang::where('new_id',$id)->where('lang','vi')->first();
                        $news_vi->title=$title_vi;
                        $news_vi->content=$content_vi;

                        $news_en=News_lang::where('new_id',$id)->where('lang','en')->first();
                        $news_en->title=$title_en;
                        $news_en->content=$content_en;

                        $news_vi->save();
                        $news_en->save();
                        return redirect('admin/news-home')->with('thongbao','Thêm tin tức thành công!');
                    }
                    else{
                        return redirect('admin/news-home')->with('thatbai','Thêm tin tức thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                dd($e);
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function SaveNewsGallery(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $title_vi=$request->title_vi;
                $title_en=$request->title_en;
                $content_vi=$request->content_vi;
                $content_en=$request->content_en;
                $keyword=$request->keyword;
                $description=$request->description;
                $author=$request->author;
                $is_form = $request->has('txtform') ? 1 : 0;
                if($id==0)
                {
                    $news=new News;
                    $news->id_category=2;
                    $news->status=1;
                    $news->slug=str_slug($title_vi);
                    $news->seo_keyword=$keyword;
                    $news->seo_description=$description;
                    $news->seo_author=$author;
                    $news->is_form=$is_form;
                    if($request->hasFile('file')){
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/news/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $news->image=$filename;
                    }
                    if($news->save())
                    {
                        $news_vi=new News_lang;
                        $news_vi->new_id=$news->id;
                        $news_vi->lang='vi';
                        $news_vi->title=$title_vi;
                        $news_vi->content=$content_vi;

                        $news_en=new News_lang;
                        $news_en->new_id=$news->id;
                        $news_en->lang='en';
                        $news_en->title=$title_en;
                        $news_en->content=$content_en;

                        $news_vi->save();
                        $news_en->save();
                        return redirect('admin/news-gallery-home')->with('thongbao','Thêm tin tức thành công!');
                    }
                    else{
                        return redirect('admin/news-gallery-home')->with('thatbai','Thêm tin tức thất bại!');
                    }
                }
                else{
                    $news=News::find($id);
                    $news->slug=str_slug($title_vi);
                    $news->seo_keyword=$keyword;
                    $news->seo_description=$description;
                    $news->seo_author=$author;
                    $news->is_form=$is_form;
                    if($request->hasFile('file')){
                        unlink('images/news/'.$news->image);
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/news/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $news->image=$filename;
                    }
                    if($news->save())
                    {
                        $news_vi=News_lang::where('new_id',$id)->where('lang','vi')->first();
                        $news_vi->title=$title_vi;
                        $news_vi->content=$content_vi;

                        $news_en=News_lang::where('new_id',$id)->where('lang','en')->first();
                        $news_en->title=$title_en;
                        $news_en->content=$content_en;

                        $news_vi->save();
                        $news_en->save();
                        return redirect('admin/news-gallery-home')->with('thongbao','Thêm tin tức thành công!');
                    }
                    else{
                        return redirect('admin/news-gallery-home')->with('thatbai','Thêm tin tức thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                dd($e);
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function DeleteNews($id)
    {
        if(Auth::check()){
            try{
                $news=News::find($id);
                unlink('images/news/'.$news->image);
                $news->status=0;
                $news->save();
                return redirect('admin/news-home')->with('thongbao','Xóa Thành công!');
            }
            catch (\Exception $e)
            {
                return redirect('admin/news-home')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function NewsGalleryImageHome($id)
    {
        if(Auth::check()){
                $images=Gallery_Image::where('id_news',$id)->where('status',1)->orderBy('id','desc')->get();
                return view('admin.news.image_news',['images'=>$images,'id'=>$id]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveNewsGalleryImage(Request $request)
    {
        if(Auth::check()){
            try{
                $id_new=$request->txtid_news;
                $id=$request->txtid;
                $name=$request->name_vi;
                $name_en=$request->name_en;
                if($id==0)
                {
                    $gallery=new Gallery_Image;
                    $gallery->id_news=$id_new;
                    $gallery->name=$name;
                    $gallery->name_en=$name_en;
                    $gallery->status=1;
                    if($request->hasFile('file'))
                    {
                        $file=$request->file('file');
                        $filename  = time() . '.' . $file->getClientOriginalExtension();
                        $path = public_path('images/gallery_image/' . $filename);
                        Image::make($file->getRealPath())->resize(300, 200)->save($path);
                        $gallery->image=$filename;
                    }
                    if($gallery->save())
                    {
                        return redirect('admin/news-gallery-image/'.$id_new)->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/news-gallery-image/'.$id_new)->with('thatbai','Thêm thất bại!');
                    }
                }
                else{
                    $gallery=Gallery_Image::find($id);
                    $gallery->name=$name;
                    $gallery->name_en=$name_en;
                    if($request->hasFile('file'))
                    {
                        unlink('images/gallery_image/'.$gallery->image);
                        $file=$request->file('file');
                        $filename  = time() . '.' . $file->getClientOriginalExtension();
                        $path = public_path('images/gallery_image/' . $filename);
                        Image::make($file->getRealPath())->resize(300, 200)->save($path);
                        $gallery->image=$filename;
                    }
                    if($gallery->save())
                    {
                        return redirect('admin/news-gallery-image/'.$id_new)->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/news-gallery-image/'.$id_new)->with('thatbai','Thêm thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                dd($e);
                return redirect('admin/news-gallery-image/'.$id_new)->with('thatbai','Thêm thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeleteGalleryImage($idnews,$id)
    {
        if(Auth::check()){
            $gallery=Gallery_Image::find($id);
            $gallery->status=0;
            unlink('images/gallery_image/'.$gallery->image);
            if($gallery->save())
            {
                return redirect('admin/news-gallery-image/'.$idnews)->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/news-gallery-image/'.$idnews)->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }

    public function GalleryVideoHome()
    {
        $video=Gallery_Video::where('status',1)->orderBy('id','desc')->get();
        return view('admin.news.gallery_video',['video'=>$video]);
    }
    public function SaveGalleryVideo(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $url=$request->txtlink;
                $sort=$request->txtthutu;
                $title=$request->title_vi;
                $title_en=$request->title_en;
                $show=0;
                $thumb1=substr($url,32);
                $tr=explode("&", $thumb1);
                $thumb=$tr[0];
                if($request->txtshow)
                {
                    $show=1;
                }
                if($id==0)
                {
                    $slide=new Gallery_Video();
                    $slide->is_show=$show;
                    $slide->url=$url;
                    $slide->thumb=$thumb;
                    $slide->sort_order=$sort;
                    $slide->status=1;
                    $slide->title=$title;
                    $slide->title_en=$title_en;
                    if($slide->save())
                    {
                        return redirect('admin/gallery-video')->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/gallery-video')->with('thatbai','Thêm thất bại!');
                    }
                }
                else{
                    $slide=Gallery_Video::find($id);
                    $slide->is_show=$show;
                    $slide->sort_order=$sort;
                    $slide->url=$url;
                    $slide->thumb=$thumb;
                    $slide->title=$title;
                    $slide->title_en=$title_en;
                    if($slide->save())
                    {
                        return redirect('admin/gallery-video')->with('thongbao','Cập nhật thành công!');
                    }
                    else{
                        return redirect('admin/gallery-video')->with('thatbai','Cập nhật thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/gallery-video')->with('thatbai','Thêm thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeleteGalleryVideo($id)
    {
        $slide=Gallery_Video::find($id);
        $slide->status=0;
        if($slide->save())
        {
            return redirect('admin/gallery-video')->with('thongbao','Xóa thành công!');
        }
        else{
            return redirect('admin/gallery-video')->with('thatbai','Xóa thất bại!');
        }
    }
}
