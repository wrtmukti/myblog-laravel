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
  {{-- status --}}
  @if (session('status'))
  <div class="alert alert-success">
      {{ session('status') }}
  </div>
@endif
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold leading-tight text-gray-900">
            {{ $articles->title }}
          </h1>
            <div class="flex justify-between items-center">
                <div>
                    <span class="font-light text-gray-600 text-xs">dibuat pada : {{ $articles ->created_at }}</span><br>
                    <span class="font-light text-gray-600 text-xs">terakhir update : {{ $articles ->updated_at }}</span><br>
                    <span class="font-light text-gray-600 text-xs">by: {{ $articles->user->name }}</span>
                </div>

                @if (Auth::user()->id == $articles->user_id)                
                      <div>
                          <a href="/users/{{ Auth::user()->id }}/article/{{ $articles->id }}/edit" class="px-2 py-1 mx-2 bg-blue-600 text-gray-100 font-bold rounded hover:bg-gray-500">ubah</a>
                          <form action="/users/{{ Auth::user()->id }}/article/{{ $articles->id }}/delete" method="POST" class="d-inline" >
                            @method('delete')
                            @csrf
                            <button type="submit" class="px-2 py-1 bg-red-600 text-gray-100 font-bold rounded hover:bg-gray-500r">hapus</button>
                          </form>
                          
                      </div> 
                      @else
                      <a href="#" class="px-2 py-1 bg-pink-500 text-gray-100 font-bold rounded hover:bg-gray-500">likes:</a>
                  
                @endif
                
                
            </div>
        </div>
      </header>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <h3>kategori : {{ $articles->category }}</h3>
      <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <p>{{ $articles->text }}</p>
        </div>

        {{-- <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
         @foreach ($comments as $comment)
         <br>
            <p>{{ $comment->user->name }} : {{ $comment->text }}</p>           
         @endforeach 

         <form action="/users/{{ $comment->user->id }}/article/{{ $articles->id }}/show " method="POST">
          @csrf 
          <input type="text" name="text" class="border-4">
          <input type="submit" value="tambah komentar">

         </form>
      </div> --}}
      </div>
    </div>
  </main>
@endsection