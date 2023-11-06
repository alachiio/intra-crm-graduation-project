<div class="mt-4" x-data="{
        permissions: @entangle('permissions'),
        init() {
            document.querySelectorAll('.check-all').forEach(item => {
                this.bulkToggle(item, item.dataset.value);
            })
        },
        checkAll(type) {
            document.querySelectorAll(`input[data-type='${type}']`).forEach(item => {
                if (this.$event.target.checked) {
                    this.permissions.push(item.value)
                } else {
                    this.permissions = this.permissions.filter(val => val !== item.value);
                }
            })
        },
        bulkToggle($el, type = null) {
            if(type == null)
                type = $el.dataset.type;
            const checkAll = document.querySelector(`input[data-value='${type}']`);
            if(document.querySelectorAll(`input[data-type='${type}']:not(:checked)`).length == 0) {
                checkAll.checked = true;
            } else {
                checkAll.checked = false;
            }
        }
    }">
    {{--    <h2 class="text-xl">{{ __('Permissions') }}</h2>--}}
    <table class="w-full">
        <thead>
        <tr class="text-left rtl:text-right">
            <th class="w-1/2 px-3 py-3">{{ __('Bulk') }}</th>
            <th>
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox is-outline circle check-all"
                           data-value="view"
                           x-on:change="checkAll('view')">
                    <p>{{ __('View', ['name' => '']) }}</p>
                </label>
            </th>
            <th>
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox is-outline circle check-all"
                           data-value="create"
                           x-on:change="checkAll('create')">
                    <p>{{ __('Create', ['name' => '']) }}</p>
                </label>
            </th>
            <th>
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox is-outline circle check-all"
                           data-value="update"
                           x-on:change="checkAll('update')">
                    <p>{{ __('Edit', ['name' => '']) }}</p>
                </label>
            </th>
            <th>
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox is-outline circle check-all"
                           data-value="delete"
                           x-on:change="checkAll('delete')">
                    <p>{{ __('Delete', ['name' => '']) }}</p>
                </label>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach(getModels() as $key => $value)
            <tr>
                <td class="py-2 px-3">{{ $value }}</td>
                <td class="py-2">
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox is-outline circle"
                               data-type="view" value="{{$key}}.view" x-model="permissions" wire:model.defer="permissions"
                               x-on:change="bulkToggle($el)">
                        <p>{{ __('View', ['name' => '']) }}</p>
                    </label>
                </td>
                <td class="py-2">
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox is-outline circle"
                               data-type="create" value="{{$key}}.create" x-model="permissions" wire:model.defer="permissions"
                               x-on:change="bulkToggle($el)">
                        <p>{{ __('Create', ['name' => '']) }}</p>
                    </label>
                </td>
                <td class="py-2">
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox is-outline circle"
                               data-type="update" value="{{$key}}.update" x-model="permissions" wire:model.defer="permissions"
                               x-on:change="bulkToggle($el)">
                        <p>{{ __('Edit', ['name' => '']) }}</p>
                    </label>
                </td>
                <td class="py-2">
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox is-outline circle"
                               data-type="delete" value="{{$key}}.delete" x-model="permissions" wire:model.defer="permissions"
                               x-on:change="bulkToggle($el)">
                        <p>{{ __('Delete', ['name' => '']) }}</p>
                    </label>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
