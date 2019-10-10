<?php

namespace App\Http\Controllers\Admin;

use App\Seopage;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeopagesController extends Controller
{
    public function index(){

        $this->view = 'admin.seopage.index';
        $this->title = 'Список тегов';

        $this->data['seopages'] = Seopage::all();
        return $this->render();
    }

    public function form($url='', $town=''){
        $this->view = 'admin.seopage.form';

        $this->title = 'Seo теги - ';
        if($town){
            $this->title .= Town::find($town)->name;
            $this->data['town'] = $town;
        }
        $this->longtitle = str_replace('-', '/', $url);

        $this->data['url'] = $url;

        if($seopage = Seopage::where(['town_id'=>$town, 'url'=>$url])->first()){
            $this->data['_title'] = $seopage->title;
            $this->data['description'] = $seopage->description;
            $this->data['keywords'] = $seopage->keywords;
        }else{
            $this->data['_title'] = '';
            $this->data['description'] = '';
            $this->data['keywords'] = '';
        }

        return $this->render();
    }

    public function save(Request $inputs){
        $seopage = Seopage::where(['url'=>request()->get('url'), 'town_id'=>request()->get('town')])->first();

        if($seopage){
            $update = true;
            $seopage->title = request()->get('title');
            $seopage->description = request()->get('description');
            $seopage->keywords = request()->get('keywords');

        }else{
            $update = false;
            $seopage = new Seopage();

            if(request()->get('town')){
                $seopage->town_id = request()->get('town');
            }

            $seopage->url = request()->get('url');
            $seopage->title = request()->get('title');
            $seopage->description = request()->get('description');
            $seopage->keywords = request()->get('keywords');
        }

        if($seopage->save()){
            cache()->forget('seopage');

            return redirect()
                ->route('admin.seopages.index')
                ->with('success', 'Seo теги "'.request()->get('name').'" были успешно '.($update ? 'обновлены':'созданы').'!');
        }
    }

}
