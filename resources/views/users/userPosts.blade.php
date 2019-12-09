@foreach($posts as $post)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="p-2">
                    <a style="text-decoration:none;" href="/posts/{{$post->id}}"> <h5>{{$post->title}}</h5> </a>
                    <small>Written {{$post->created_at->diffForHumans()}}</small>
                </div>
            </div>
        </div>
    </div>
@endforeach
<br>
{{$posts->render()}} <!-- Pagination -->