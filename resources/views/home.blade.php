<x-app-layout>
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-black-200 leading-tight">
          {{ __('Home') }}
        
      </h2>
  </x-slot>
    @if(!auth()->check())
    <div class="d-flex flex-row m-5">

    <div class="d-flex justify-content-center max-w-sm rounded overflow-hidden shadow-lg m-5">
      {{-- <img class="w-full" src="/img/card-top.jpg" alt="Sunset in the mountains"> --}}
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
        <p class="text-gray-700 text-base">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
        </p>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
            {{ __('Register') }}
          </x-nav-link>
        </button>
      </div>
      <div class="px-6 pt-4 pb-2">
       
      </div>
    </div>
        
    <div class="d-flex justify-content-center max-w-sm rounded overflow-hidden shadow-lg m-5">
      {{-- <img class="w-full" src="/img/card-top.jpg" alt="Sunset in the mountains"> --}}
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
        <p class="text-gray-700 text-base">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
        </p>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
            {{ __('Login') }}
          </x-nav-link>
        </button>
      </div>
      <div class="px-6 pt-4 pb-2">
       
      </div>
    </div>

  </div>
    @else
    <div class="row m-5">
      @foreach ($posts as $post)
        <div class="col-12 col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
              <p class="card-text text-secondary">{{ $post->body }}</p>
              <p class="text-secondary font-weight-bold">By: {{ $post->user->name }}</p>
    
              <form method="POST" action="/store-comment">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                {{-- <input type="hidden" name="post_id" value="{{ $user->id }}"> --}}
  
                <div class="row">
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Comments" aria-label="First name" name="body">
                    <button value="Comment" type="submit" class="btn btn-outline-info m-1">Post Comment</button>
                  </div>
                </div>
              </form>
    
              <div class="comments-section mt-4">
                <h6 class="font-weight-bold">Comments</h6>
                @foreach ($post->comments as $comment)
                  <p class="text-secondary"> By: {{ $comment->user->name }} <br>
                    {{ $comment->body }}</p>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      @endforeach
      {{$posts->links()}}
    </div>
        
    @endif
</x-app-layout>