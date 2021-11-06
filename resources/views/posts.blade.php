@extends('layouts.app')
@section('title') {{$post->title}} @endsection


@section('content')

    <div class="container mx-auto flex flex-wrap py-6">

        <section class="w-full px-3">
            <div class="text-sm breadcrumbs">
                <ul>
                    <li>
                        <a href="{{url()}}">首页</a>
                    </li>
                    <li>
                        <a href="{{route('posts',['title'=>str_replace(' ','-',$post->title)])}}">{{$post->title}}</a>
                    </li>
                </ul>
            </div>
        </section>



        <!-- Post Section -->
        <section class="w-full card md:w-2/3 flex flex-col items-center px-8">
            <article class="prose  flex w-full flex-col shadow-xl my-4">
                <!-- Article Image -->
                <a href="#" class="hover:opacity-75">
                    <img src="">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$post->category->first()->name ?? "未分类"}}</a>
                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$post->title}}</a>
                    <p href="#" class="text-sm pb-8">
                        @isset($post->author->name)发布者 <a href="#" class="font-semibold hover:text-gray-800">{{$post->author->name}}</a> @endisset 上次更新于: {{\Carbon\Carbon::make($post->updated_at)->toDayDateTimeString()}}
                    </p>
                    {!! $post->content !!}
                </div>
            </article>

            {{--            <div class="w-full flex pt-6">--}}
            {{--                <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">--}}
            {{--                    <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i> Previous</p>--}}
            {{--                    <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>--}}
            {{--                </a>--}}
            {{--                <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">--}}
            {{--                    <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i class="fas fa-arrow-right pl-1"></i></p>--}}
            {{--                    <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>--}}
            {{--                </a>--}}
            {{--            </div>--}}


        </section>

        @isset($post->author)
            <div class="card px-8 text-center shadow-xl w-full md:w-1/3 flex flex-col items-center px-3">
                <figure class="px-10 pt-10">
                    <div class="avatar justify-center">
                        <div class="rounded-full w-24 h-24">
                            <img src="{{$post->author->avatar}}">
                        </div>
                    </div>
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{$post->author->name}}</h2>
                    <p>{{$post->author->desc}}</p>
                    <div class="justify-center card-actions">
                        {{--                            <button class="btn btn-outline btn-accent">More info</button>--}}
                    </div>
                </div>
            </div>
        @endisset


    </div>

@endsection

