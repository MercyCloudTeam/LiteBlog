@extends('layouts.app')
@section('title') 首页 @endsection


@section('css')
        @isset($index_seo_title)
            <meta name="title" content="{{$index_seo_title}}">
        @endisset
        @isset($index_seo_description)
            <meta name="description" content="{{$index_seo_description}}">
        @endisset
        @isset($index_seo_keywords)
            <meta name="keywords" content="{{$index_seo_keywords}}">
        @endisset
@endsection

@section('content')
    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            @foreach($posts as $item)

                <article class="flex flex-col font-sans shadow-lg my-4 w-full">
                    <!-- Article Image -->
                    <a href="#" class="hover:opacity-75">
                        <img src="">
                    </a>
                    <div class="bg-white flex flex-col justify-start p-6">
                        <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$item->category->first()->name ?? "未分类"}}</a>
                        <a href="{{route('posts',['title'=>str_replace(' ','-',$item->title)])}}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$item->title}}</a>
                        <p  class="text-sm pb-3">
                            @isset($item->author->name)发布者 <a href="{{route('author',['name'=>$item->author->name])}}" class="font-semibold hover:text-gray-800">{{$item->author->name}}</a> @endisset 上次更新于: {{\Carbon\Carbon::make($item->updated_at)->toDayDateTimeString()}}
                        </p>
                        <a href="#" class="pb-6">{{$item->subtitle}}</a>
                        <a href="{{route('posts',['title'=>str_replace(' ','-',$item->title)])}}" class="uppercase text-gray-800 hover:text-black">阅读文章 <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

            @endforeach
                <div class="btn-group justify-center mt-4 mb-4 ">
                    <a href="{{$posts->previousPageUrl()}}" class="btn btn-outline btn-wide">Previous Page</a>
                    <a href="{{$posts->nextPageUrl()}}" class="btn btn-outline btn-wide">Next Page</a>
                </div>


        </section>

        <!-- 关于本站 -->
        @isset($index_description)
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">
            <div class="w-full bg-white  shadow-lg flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">关于本站</p>
                <p class="pb-2">{{$index_description}}</p>
{{--                <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">--}}
{{--                    Get to know us--}}
{{--                </a>--}}
            </div>
        </aside>
        @endisset

        <!-- 文章小窗 -->


        <!--  TAG列表 -->
    </div>

@endsection
