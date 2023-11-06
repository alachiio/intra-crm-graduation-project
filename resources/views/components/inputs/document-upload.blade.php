@props(['documents'])
<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <div class="flex mb-4">
        <h3 class="me-auto font-bold text-tawrid-primary-100"> {{ __('strings.add_files') }}
            <x-spinners.circle target="documents" class="w-10 text-tawrid-secondary-100"></x-spinners.circle>
        </h3>
        <x-buttons.button type="button" class="bg-secondary text-white" wire:click="document('append')"><i
                class="bx bx-plus"></i> {{ __('strings.add_new') }}</x-buttons.button>
    </div>
    @if($documents)
        <div class="grid grid-cols-2 gap-2">
            @foreach($documents as $index => $document)
                <div class="p-3 rounded shadow bg-body">
                    <div class="flex space-x-3 items-center">
                        <input type="text" class="form-control" name="documents.{{$index}}.name.{{default_lang()}}"
                               wire:model.defer="documents.{{$index}}.name.{{default_lang()}}"
                               placeholder="{{ __('strings.name') }}" required>
                        <label>
                        <span class="text-2xl bg-primary text-white px-2 py-1 rounded shadow cursor-pointer">
                            <i class="bx bx-upload"></i>
                        </span>
                            <input id="documents.{{$index}}.path" type="file" class="hidden"
                                   name="documents.{{$index}}.path"
                                   wire:model.defer="documents.{{$index}}.path"
                                   accept="application/pdf,.doc,.docx,.xls,.xlsx">
                        </label>
                        @if($document['path'])
                            <i class="bx bxs-file-doc text-2xl"></i>
                            @php
                                $id = (array_key_exists('id', $document)) ? $document['id'] : null;
                            @endphp
                            <x-modals.modal-delete name="deleteDocument{{$index}}" action="document('delete', {{ $index }}, {{ $id }})"/>
                        @endif
                    </div>
                    @error("documents.$index.path") <span class="error">{{ $message }}</span> @enderror
                </div>
            @endforeach
        </div>
    @endif
</div>


