<div class="m-1 max-w-lg" style="max-width: 32rem">
  <div class="text-right mb-1 w-full">
    <span class="text-indigo-500">
      Found [<b>{{ $users->count() }}</b>] users
    </span>
  </div>
  @foreach($users as $user)
    <div class="mb-1">
      <div class="flex space-x-2">
        <span class="font-bold">{{ $user->fullname }}</span>
        <span class="text-gray">[{{ $user->email }}]</span>
        <span class="flex-1 content-repeat-[.] text-gray"></span>
        <span class="text-gray">Approved:</span>
        @if ($user->email_verified_at)
          <span class="font-bold text-green">{{ date('d.m.Y, H:i:s', strtotime($user->email_verified_at)) }}</span>
        @else
          <span class="font-bold text-red">NO!</span>
        @endif
      </div>
    </div>
  @endforeach
</div>