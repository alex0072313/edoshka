<?php

namespace App\Http\Controllers\Admin;

use App\Helpmsg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpmsgsController extends Controller
{
    public function index(){

        $this->view = 'admin.helpmsg.index';
        $this->title = 'Список областей';

        $this->data['helpmsgs'] = Helpmsg::all();

        return $this->render();
    }

    public function helpmsgEditForm($page='', $name=''){
        $this->view = 'admin.helpmsg.form';

        $this->title = 'Редактирование области - ';
        $this->longtitle = $name;

        $this->data['name'] = $name;
        $this->data['page'] = $page;

        if($helpmsg = Helpmsg::where(['name'=>$name])->first()){
            $this->data['value'] = $helpmsg->value;
        }else{
            $this->data['value'] = '';
        }

        return $this->render();
    }

    public function helpmsgSave(Request $inputs){
        $helpmsg = Helpmsg::where(['name'=>request()->get('name')])->first();

        if($helpmsg){
            $update = true;
            $helpmsg->value = request()->get('value');
        }else{
            $update = false;
            $helpmsg = new Helpmsg();
            $helpmsg->value = request()->get('value');
            $helpmsg->name = request()->get('name');
            $helpmsg->page = request()->get('page');
        }

        if($helpmsg->save()){
            cache()->forget('helpmsgs_on_page');

            return redirect()
                ->route('admin.helpmsgs.index')
                ->with('success', 'Поле "'.request()->get('name').'" было успешно '.($update ? 'обновлено':'создано').'!');
        }
    }

}
