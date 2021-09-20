@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('updated'))
            <div class="alert alert-success">
                {{ session('updated') }}
            </div>            
        @endif
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Azioni</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id}}</th>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if ($post->category)
                                {{ $post->category->name }}                               
                            @endif
                        </td> 
                        <td>
                            <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post" class="d-inline-block delete-post-form">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>                        
                    </tr>
                    
                @endforeach              
            </tbody>
        </table>

        <h2 class="mt-5">Post per categorie</h2>
        @foreach ($categories as $category)
            <h3>{{ $category->name }}</h3>
                @forelse ($category->posts as $post)
                    <h4><a href="{{ route('admin.posts.show', $post->slug) }}">{{ $post->title }}</a></h4>                
                @empty
                    <p>Non ci sono post per questa categoria.
                        <a href="{{ route('admin.posts.create') }}">Scrivine uno</a>
                    </p>                
            @endforelse
        @endforeach

    </div>    
@endsection