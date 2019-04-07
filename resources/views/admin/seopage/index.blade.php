@extends('layouts.admin')

@section('content')
    {{--<a href="{{ route('admin.helpmsgs.create') }}" class="btn btn-primary btn-lg mb-4">Добавить поле</a>--}}
    @if(count($seopages))
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th>Url</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Keywords</th>
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($seopages as $seopage)
                    <tr>
                        <td><a href="{{ route('admin.seopages.edit', ['town'=>$seopage->town_id, 'url'=>$seopage->url]) }}">{{ str_replace('-', '/', $seopage->url) }} </a></td>
                        <td>{{ $seopage->title }}</td>
                        <td>{{ $seopage->description }}</td>
                        <td>{{ $seopage->keywords }}</td>
                        <td class="with-btn text-center" nowrap>
                            <a href="{{ route('admin.seopages.edit', ['town'=>$seopage->town_id, 'url'=>$seopage->url]) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет добавленных Seo тегов
        </p>
    @endif

@endsection
