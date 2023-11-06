@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input grow border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10
hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent rounded-lg']) !!}>
