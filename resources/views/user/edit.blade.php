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
 <main>
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

                {{-- form --}}              
                <div class="w-full  min-w-0 mx-auto px-6">
                    <div class="flex mt-12 bg-white rounded-md shadow">
                        <div class="flex-grow">
                            <div class="flex flex-col mx-40 mt-20">

                                    <form action="/users/{{ Auth::user()->id }}/dashboard " method="POST">
                                        @method('PUT')
                                        @csrf 
                                        <input type="hidden" name="id" value="{{ $article->id }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <div class="flex items-center mb-4">
                                            <label for="title" class="w-24 font-semibold text-gray-700">Judul</label>
                                            <input type="text" class="flex-grow border border-red-200 rounded py-1 px-3 @error('title') is-invalid @enderror" id="title" name="title" value=" {{ $article->title }}">
                                            @error('title')<div class="invalid-feedback"> {{ $message }}</div>@enderror
                                        </div>
                                        <div class="flex items-center mb-4">
                                            <label for="category" class="w-24 font-semibold text-gray-700">Kategori</label>
                                            <input type="text" class="flex-grow border border-red-200 rounded py-1 px-3 @error('category') is-invalid @enderror" id="category" name="category" value=" {{ $article->category }}">
                                            @error('category')<div class="invalid-feedback"> {{ $message }}</div>@enderror                                        </div>
                                        <div class="flex items-center mb-4">
                                            <label for="text" class="w-24 font-semibold text-gray-700">isi</label>
                                            <input type="text" rows="8" class="flex-grow border border-red-200 rounded py-1 px-3  @error('text') is-invalid @enderror" id="text" name="text" value="{{ $article->text }}"></input>
                                            @error('text')<div class="invalid-feedback"> {{ $message }}</div>@enderror                                        </div>
                                       
                                            <input type="hidden" name="public" value="{{ $article->public }}">

                                        <div class="flex items-center mb-4">
                                            <button type="submit" class="py-1 px-4 bg-red-800 text-red-100 font-semibold hover:bg-red-900 hover:shadow border border-red-200 rounded mr-2">Submit</button>
                                            <button class="py-1 px-4 bg-white text-red-700 font-semibold hover:shadow border border-red-200 rounded">Cancel</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                          
</main>
       
    </ul>
@endsection