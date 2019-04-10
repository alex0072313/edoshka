@extends('layouts.site', ['body_class'=>'category_page'])

@section('content')
    <section id="greetin_page_default" class="shop" style="background-image: url('/images/theme/article_bg.jpg');">
        <div class="container">
            <div class="d-flex align-content-end flex-wrap inner w-auto">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    {{ @Breadcrumbs::render() }}
                </nav>
                <div class="h1 w-100 font-weight-bolder text-white mb-3">
                    {!! $article->long_title ?? $article->title !!}
                </div>
            </div>
        </div>
    </section>

    <section id="article" class="mb-5">
        <div class="container">
            {!! $article->text !!}
        </div>
    </section>

@endsection
