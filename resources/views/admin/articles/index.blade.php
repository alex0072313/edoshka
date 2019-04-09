@extends('layouts.admin')

@section('content')

    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-lg mb-4">Добавить статью</a>

    @if(count($articles))
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th width="1%" class="pr-0">ID</th>
                    <th>Заголовок</th>
                    <th>Алиас</th>
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td class="pr-0">
                            {{ $article->id }}
                        </td>
                        <td>
                            {{ $article->title }}
                        </td>
                        <td>
                            {{ $article->alias }}
                        </td>
                        <td class="with-btn text-center" nowrap>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            <a href="{{ route('admin.articles.destroy', $article->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить статью {{ $article->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    @else
        <p class="lead">
            Нет добавленных статей
        </p>
    @endif


@endsection
