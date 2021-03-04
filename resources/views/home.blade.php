@extends('layouts.main')

@section('menu')  
     {{-- search bar --}}
     <div class="shadow flex">
        <input class="w-full rounded p-1 " type="text" placeholder="cari artikel..">
        <button class=" bg-gray-500 text-gray-100 mx-2 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm ">
            <i class="">cari</i>
        </button>
    </div>
@endsection

@section('content')
    <header class=" bg-white shadow ">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 ">
            @if (Route::has('login'))                     
                @auth
                    
                   <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a href=" users/ {{ Auth::user()->id }}/dashboard " class=" bg-cool-gray-900 text-gray-300  hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium ">Dashboard</a>
                
                    @else
                        <a href="{{ route('register') }}" class=" bg-cool-gray-900 text-gray-300  hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium ">mau buat artikel juga?</a>                
                @endauth 
            @endif

        </div>
    </header>

    <main>
        {{-- <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <div class="border-4 border-dashed border-gray-200 rounded-lg h-96"></div>
        </div>
        <!-- /End replace -->
        </div> --}}

        <div class="bg-gray-100 overflow-x-hidden">
            <div class="px-6 py-8">
                <div class="flex justify-between container mx-auto">
                    <div class="w-full lg:w-8/12">

                        {{-- filter --}}
                        <div class="flex items-center justify-between">
                            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Post</h1>
                            <div>
                                <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option>Latest</option>
                                    <option>Last Week</option>
                                </select>
                            </div>
                        </div>

                        {{-- card --}}
                        @foreach ($articles as $article)
                            <div class="mt-6">
                                <div class="max-w-4xl px-10 py-6 bg-white rounded-lg shadow-md">
                                    <div class="flex justify-between items-center">
                                        <span class="font-light text-gray-600 text-xs">{{ $article -> created_at }}</span>
                                        <a href="#" class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">{{ $article->category }}</a>
                                    </div>
                                    <div class="mt-2">
                                        <a href="#" class="text-2xl text-gray-700 font-bold hover:underline">{{ $article -> title }}</a>
                                        <p class="mt-2 text-gray-600">{{ $article -> text }}</p>
                                    </div>
                                    <div class="flex justify-between items-center mt-4">
                                        {{-- <a href="/users/{{ Auth::user()->id }}/article/{{ $article->id }}/show" class="text-blue-500 hover:underline">Read more</a> --}}
                                        <a href="/users/{{ $article->user_id }}/article/{{ $article-> id }}/show" class="text-blue-500 hover:underline">Read more</a>
                                        
                                        <div>
                                            <a href="#" class="flex items-center">
                                                <img src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=731&amp;q=80"
                                                    alt="avatar" class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block">
                                                <h1 class="text-gray-700 font-bold hover:underline">{{ $article->user-> name }}</h1>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        
                        <div class="mt-8">
                            <div class="flex">
                                <a href="#" class="mx-1 px-3 py-2 bg-white text-gray-500 font-medium rounded-md cursor-not-allowed">
                                    previous
                                </a>
                            
                                <a href="#" class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                                    1
                                </a>
                            
                                <a href="#" class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                                    2
                                </a>
                            
                                <a href="#" class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                                    3
                                </a>
                            
                                <a href="#" class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="-mx-8 w-4/12 hidden lg:block">
                        <div class="px-8">
                            <h1 class="mb-4 text-xl font-bold text-gray-700">Authors</h1>
                            <div class="flex flex-col bg-white max-w-sm px-6 py-4 mx-auto rounded-lg shadow-md">
                                <ul class="-mx-4">

                                    @foreach ($users as $user )                                                                            
                                    <li class="flex items-center mt-3"><img
                                            src="https://images.unsplash.com/photo-1464863979621-258859e62245?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=333&amp;q=80"
                                            alt="avatar" class="w-10 h-10 object-cover rounded-full mx-4">
                                        <p><a href="#" class="text-gray-700 font-bold mx-1 hover:underline">{{ $user->name }}</a><span
                                                class="text-gray-700 text-sm font-light"> post ceated: {{ $user->articles->count() }}</span></p>
                                    </li>
                                    @endforeach

                                    
                                </ul>
                            </div>
                        </div>

                        <div class="mt-10 px-8">
                            <h1 class="mb-4 text-xl font-bold text-gray-700">Recent Post</h1>
                            <div class="flex flex-col bg-white px-8 py-6 max-w-sm mx-auto rounded-lg shadow-md">
                                <div class="flex justify-center items-center"><a href="#"
                                        class="px-2 py-1 bg-gray-600 text-sm text-green-100 rounded hover:bg-gray-500">Laravel</a>
                                </div>
                                <div class="mt-4"><a href="#" class="text-lg text-gray-700 font-medium hover:underline">Build
                                        Your New Idea with Laravel Freamwork.</a></div>
                                <div class="flex justify-between items-center mt-4">
                                    <div class="flex items-center"><img
                                            src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=731&amp;q=80"
                                            alt="avatar" class="w-8 h-8 object-cover rounded-full"><a href="#"
                                            class="text-gray-700 text-sm mx-3 hover:underline">Alex John</a></div><span
                                        class="font-light text-sm text-gray-600">Jun 1, 2020</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 px-8">
                            <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
                            <div class="flex flex-col bg-white px-4 py-6 max-w-sm mx-auto rounded-lg shadow-md">
                                <ul>
                                    <li><a href="#" class="text-gray-700 font-bold mx-1 hover:text-gray-600 hover:underline">-
                                            AWS</a></li>
                                    <li class="mt-2"><a href="#"
                                            class="text-gray-700 font-bold mx-1 hover:text-gray-600 hover:underline">-
                                            Laravel</a></li>
                                    <li class="mt-2"><a href="#"
                                            class="text-gray-700 font-bold mx-1 hover:text-gray-600 hover:underline">- Vue</a>
                                    </li>
                                    <li class="mt-2"><a href="#"
                                            class="text-gray-700 font-bold mx-1 hover:text-gray-600 hover:underline">-
                                            Design</a></li>
                                    <li class="flex items-center mt-2"><a href="#"
                                            class="text-gray-700 font-bold mx-1 hover:text-gray-600 hover:underline">-
                                            Django</a></li>
                                    <li class="flex items-center mt-2"><a href="#"
                                            class="text-gray-700 font-bold mx-1 hover:text-gray-600 hover:underline">- PHP</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    
@endsection