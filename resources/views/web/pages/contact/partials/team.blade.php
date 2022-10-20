@if ($members)
  @foreach($members as $member)
    <x-card-text class="card-team">
      <x-slot name="aside">
        <figure class="text-media__visual">
          @if ($member->publishedImage)
            <x-image :maxSizes="[1000 => 1600, 700 => 1200, 0 => 900]" width="1600" height="900" :image="$member->publishedImage" ratio="16x9" :caption="$member->publishedImage" />
          @else
            <img src="/media/viak-placeholder-visual.png" width="1600" height="900" class="is-responsive" alt="{{ $member->fullname }}">
          @endif
        </figure>
      </x-slot>
      <x-slot name="content">
       <h2>{{ $member->fullname }}</h2>
       @if ($member->title)
        <p>{{ $member->title }}</p>
       @endif
       @if ($member->info)
        <p>{!! $member->info !!}</p>
       @endif
      </x-slot>
    </x-card-text>  
  @endforeach
@endif

