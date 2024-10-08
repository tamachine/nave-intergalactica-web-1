<div class="grid grid-cols-1 md:grid-cols-3 w-100 md:pt-6 md:gap-x-6 gap-y-4">

    @foreach($latestArticles as $blogPost)
    <x-card-elongated
        background-relative-path="{{ $blogPost->getFeaturedImageModelImageInstance->url ?? '' }}"
        background-hover-relative-path="{{ $blogPost->getFeaturedImageHoverModelImageInstance->url ?? '' }}"
        title="{!! $blogPost->title !!}"
        text="{!! $blogPost->summary !!}"
        :text-for-time="$blogPost->content"
        href="{{ $blogPost->url }}"
    />
    @endforeach

</div>
