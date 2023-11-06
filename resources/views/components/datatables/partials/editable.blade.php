<div {{ $attributes }}>
    <div x-data="editable({id: row.id, name: column.name, value: helpers.getJsonValue(row, column.name.replace('->', '.')), text: helpers.getJsonValue(row, column.data.replace('->', '.')) })">
        <a @click.prevent @dblclick="toggle(true)" x-show="!isEditing"
           x-html="column.hasOwnProperty('html') ? column.html.replace('{val}', text.toLowerCase()) : text"
           class="select-none
        cursor-pointer block w-full" :class="{'py-2' : !text}"></a>
        <template x-if="column.editable.type === 'text'">
            <input type="text" x-model="value" x-show="isEditing" @click.outside="toggle(false)" @keydown.enter="submit" @keydown.window.escape="toggle(false)"
                   class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary
                   dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" x-ref="input">
        </template>
        <template x-if="column.editable.type === 'select'">
            <select x-model="value" x-show="isEditing" @click.outside="toggle(false)" @change="submit" @keydown.window.escape="toggle(false)" x-ref="input"
                    class="form-select w-full">
                <template x-for="(option, index) in column.editable.options" :key="index">
                    <option x-bind:value="index" x-text="option" x-bind:selected="index == value"></option>
                </template>
            </select>
        </template>
    </div>
</div>
