<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    @if (session()->has('status'))
    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3 mt-3" role="alert" id="status"> {{ session('status') }} </div>
    <script>
    setTimeout(function() {
      document.getElementById("status").style.display = "none";
    }, 3000);
    </script>
    @endif
    <div class="py-12">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              {{ __("All Post Data") }}
            </div>
          </div>
          <div class="row">
            @foreach ($posts as $post)
              @if ($post->user_id == Auth::user()->id)
                <div class="col-md-4">
                  <div class="card my-3">
                    <div class="card-body">
                      <h5 class="card-title font-bold text-xl">Title: {{ $post->title }}</h5>
                      <p class="card-text text-gray-700">{{ $post->body }}</p>
                      <div class="d-flex justify-between">
                        <a href="{{ url('/post/edit', $post->id) }}" class="btn btn-success">Edit</a>
                        <a href="{{ url('/post/delete', $post->id) }}" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>
</x-app-layout>
