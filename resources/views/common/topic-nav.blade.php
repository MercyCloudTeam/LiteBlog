<nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
        <a
            href="#"
            class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
            @click="open = !open"
        >
            Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>
    <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
            <a href="{{url()}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">首页</a>
            <a href="{{route('categories')}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">分类</a>
            <a href="{{route('tags')}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Tags</a>
            <a href="{{route('links')}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">友情链接</a>
        </div>
    </div>
</nav>
