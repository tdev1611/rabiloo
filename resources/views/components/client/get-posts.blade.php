@props(['post'])
<div class="item">
    <img class="img-fluid"
        src="https://images.pexels.com/photos/10835697/pexels-photo-10835697.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
        alt="">
    {{-- <div id="detail">
        <a href="{{ route('client.posts.show', $post->slug) }}" class="btn btn-secondary">Detail</a>
    </div> --}}

    <div id="name-post">
        <a href="{{ route('client.posts.show', $post->slug) }}" class="btn btn-secondary mt-3">
            <span class="mt-3">{{ $post->title }}</span> <br>
        </a>

    </div>

    <span class="text-muted">
        Lượt yêu thích :
    </span>
    <span>
        {{ $post->likes_count }}
    </span>


    @if ($post->tags->count() > 0)
        <p> Tags :
            @foreach ($post->tags as $tag)
                <span>
                    <a href="{{ route('client.posts.by.tag', $tag->slug) }}">
                        {{ $tag->title }}
                    </a>
                </span>
            @endforeach
        </p>
    @endif

    <p> Tác giả :
        <span> {{ $post->user->name }} </span>
    </p>
</div>
