@props(['user' => auth()->user()])
<div {{ $attributes->merge(['class' => 'avatar']) }}>
    <img class="rounded-full" src="{{ asset($user->avatar) }}"
         alt="{{ $user->name }}"/>
</div>
