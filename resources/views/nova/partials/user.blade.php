<dropdown-trigger class="h-9 flex items-center">
  @isset($user->email)
    <img
        src="{{ $user->avatar() }}"
        class="rounded-full w-8 h-8 mr-3"
    />
  @endisset

  <span class="text-90">
    {{ $user->name ?? $user->email ?? __('Nova User') }}
  </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
  <ul class="list-reset">
    @php
      $userResource = new \Zareismail\NovaContracts\Nova\User(request()->user());
    @endphp  
    @inject('revokeLogin', 'Zareismail\NovaContracts\Nova\Actions\RevokeLogin')
    @inject('novaRequest', 'Laravel\Nova\Http\Requests\NovaRequest')

    @if($userResource::hasMaskedLogin())
    <inline-action-selector  
      :resource='@json($userResource->serializeForIndex($novaRequest))'
      :actions='@json([ $revokeLogin->jsonSerialize() ])' 
      resource-name='{{ $userResource::uriKey() }}'
    />
    @else
    <li>
      <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">{{ 
        __('Logout') 
      }}</a>
    </li>
    @endif
  </ul>
</dropdown-menu>
