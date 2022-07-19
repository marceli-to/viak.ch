<li>
  <a href="{{ route('page.checkout.basket') }}" title="{{ __('Warenkorb') }}" class="icon-basket js-basket-counter {{ $count > 0 ? 'has-items' : '' }}">
    <div class="xs:hide">@include('web.partials.icons.basket')</div>
    <div class="sm:hide">{{__('Warenkorb') }}</div>
    <em>{{ $count }}</em>
  </a>
</li>