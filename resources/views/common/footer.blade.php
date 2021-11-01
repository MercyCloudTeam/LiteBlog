
<footer class="w-full border-t bg-white pb-12">
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
{{--          同步 友链 列表  --}}

{{--            <a href="#" class="uppercase px-3">About Us</a>--}}

        </div>
        {{--         <div>Power by <a href="https://github.com/MercyCloudTeam/LiteBlog">LiteBlog</a></div> @endisset--}}
        <div>
            @isset($beian)<a href="http://beian.miit.gov.cn/">{{$beian}}</a>@endisset
            @isset($wa)<a href="{{$wa_url}}">{{$wa}}</a>@endisset
        </div>
        @isset($power_by)
            <div class="break-words w-3/4 text-center">
                Power by <a href="https://github.com/MercyCloudTeam/LiteBlog">LiteBlog</a>
                | CSS Framework: Tailwind CSS & daisyUI | Lumen Framework
            </div>

        @endisset
        <div>  © {{date('Y')}} {{$copyright}}. All rights reserved.</div>
    </div>
</footer>
