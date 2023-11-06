<label class="mb-3 flex -space-x-px">
    <span
        class="flex shrink-0 items-center justify-center rounded-l-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450"
    >
        <span class="-mt-1">SY (+963)</span>
    </span>
    <input
        x-mask="999999999"
        class="form-input w-full rounded-r-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
        placeholder="{{ $placeholder }}"
        type="text" name="{{ $name }}" value="{{ old($name) }}"
    />
</label>
