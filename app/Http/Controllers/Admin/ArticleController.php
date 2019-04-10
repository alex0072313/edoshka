<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use Validator;

class ArticleController extends AdminController
{
    public function index()
    {
        $this->view = 'admin.articles.index';
        $this->title = 'Статьи';

        $this->data['articles'] = Article::all();

        return $this->render();
    }

    public function create()
    {
        $this->view = 'admin.articles.form';
        $this->title = 'Добавление новой статьи';

        return $this->render();
    }

    public function store(Request $request)
    {
        $validate = Validator::make(request()->all(), [
            'title' => 'required|max:255|min:3',
            'alias' => 'required|unique:articles,alias',
        ],
        [
            'title.required' => 'Укажите заголовок статьи!',
            'alias.required' => 'Укажите алиас!',
            'alias.unique' => 'Алиас должен быть уникальным!',
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при создании статьи!');
        }

        if($article = Article::create(request()->all())){

            return redirect()
                ->route('admin.articles.index')
                ->with('success', 'Статья "'.request()->get('title').'" была успешно добавлена!');
        }
    }

    public function edit(Article $article)
    {

        $this->view = 'admin.articles.form';
        $this->title = 'Редактирование статьи '.$article->title;

        $this->data['article'] = $article;

        return $this->render();
    }

    public function update(Article $article)
    {

        $validate = Validator::make(request()->all(), [
            'title' => 'required|max:255|min:3',
            'alias' => 'required|unique:articles,alias,'.$article->id,
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при обновлении статьи!');
        }


        if($article->update(request()->all())){
            return redirect()
                ->route('admin.articles.index')
                ->with('success', 'Статья "'.request()->get('title').'" была успешно обновлена!');
        }
    }

    public function destroy(Article $article)
    {
        if($article->delete()){
            return redirect()
                ->back()
                ->with('success', 'Статья "'.$article->title.'" была удалена!');
        }
    }
}
