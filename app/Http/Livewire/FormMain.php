<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class FormMain extends BaseComponent
{
    protected $model;
    protected $rules = [];
    public $props = [];
    public $files = [];
    public $unique = '';
    public $dir = '';
    public $params;
    public $formData;

    public $title;
    public $editing;

    protected $listeners = ['toast', 'paginate', 'setProperty'];

    protected function rules(): array
    {
        return [
            'props.name' => [
                'required',
                'string'
            ]
        ];
    }

    public function mount($params = [])
    {
        if (count($this->files) > 0)
            $this->dir = $this->model::FILES_DIR ?: $this->model::URL;
        $this->setParams($params);
    }

    /*
     * Functions
     */
    public function submit($formData = null, $validate = true)
    {
        if ($validate)
            $this->validate();
        $this->formData = $formData;
        DB::beginTransaction();
        try {
            $this->saveAndRedirect();
        } catch (\Exception $e) {
            DB::rollBack();
            toast('error', $e->getMessage());
        }
    }

    protected function saveAndRedirect($route = 'index')
    {
        $message = __('Data has been inserted successfully');
        $row = '';

        $this->beforeCreateOrUpdate();

        if (count($this->files) > 0) {
            foreach ($this->files as $key => $file) {
                $this->props[$key] = $this->files[$key] = doFileUpload($file, $this->editing->image ?? null, $this->dir);
            }
        }

        $this->stringsToLowerCase();

        if ($this->editing) {
            $message = __('Data has been updated successfully');
            $data = $this->props;
            $data = $this->beforeUpdate($data);
            $row = $this->editing->fill($data);
            $row->save();
            $this->afterUpdate($row);
        } else {
            $data = array_filter($this->props, fn($value) => !is_null($value) and $value != '');
            $data = $this->beforeCreate($data);
            if ($this->unique != '' and in_array(SoftDeletes::class, (new \ReflectionClass($this->model))->getTraits())) {
                $row = $this->model::withTrashed()->firstOrCreate(
                    [$this->unique => $this->props[$this->unique]],
                    Arr::except($data, $this->unique)
                );
                if ($row->trashed()) {
                    $row->update($data);
                    $row->restore();
                }
            } else {
                $row = $this->model::create($data);
            }
            $this->afterCreate($row);
        }

        $this->afterCreateOrUpdate($row);

        DB::commit();

        if ($this->isModal()) {
            $this->dispatchBrowserEvent($this->params['modal'] . 'Modal:close');
            $this->emit('toast', ['icon' => 'success', 'title' => $message]);
            $this->reset('props');
        } elseif ($route) {
            if ($route == 'self') {
                if ($this->editing) {
                    $this->emit('toast', ['icon' => 'success', 'title' => $message]);
                } else {
                    toast('success', $message);
                    $this->redirect(route($this->model::URL . '.form', ['edit', $row->id]));
                }
            } else {
                session()->flash('toast', ['icon' => 'success', 'message' => $message]);
                return redirect()->route($route);
            }
        } else {
            $this->emit('toast', ['icon' => 'success', 'title' => $message]);
            return $message;
        }
    }

    private function stringsToLowerCase()
    {
        foreach ($this->props as $key => $value) {
            if (is_string($value))
                $this->props[$key] = strtolower($value);
            else
                continue;
        }
    }

    /*
     * Hooks For Creating and Updating
     */
    protected function beforeCreateOrUpdate()// use it to set some action before creating or updating
    {
    }

    protected function beforeCreate($data) // use it to set some action before creating
    {
        return $data;
    }

    protected function beforeUpdate($data) // use it to set some action before updating
    {
        return $data;
    }

    protected function afterCreateOrUpdate($row) // use it to set some action after creating or updating
    {
    }

    protected function afterCreate($row) // use it to set some action after creating
    {
    }

    protected function afterUpdate($row)// use it to set some action after creating
    {
    }

    /*
     * End Hooks
     */

    public function toast($data, $type = 'toast')
    {
        $this->dispatchBrowserEvent($type, $data);
    }

    public function isModal()
    {
        return array_key_exists('modal', $this->params);
    }

    public function unlinkFile($prop)
    {
        $prop = explode('.', $prop)[1];
        if ($this->editing and $this->editing->$prop) {
            Storage::disk('public')->delete($this->editing->$prop);
            $this->editing->update([
                $prop => null
            ]);
        }
        $this->files[$prop] = '';
    }

    protected function mergePropsWithFiles()
    {
        return array_merge($this->props, $this->files);
    }

    protected function validationAttributes(): array
    {
        return validation_attributes(); // In Helper File
    }

    /*
     * Events
     */
    protected function setParams($params)
    {
        if ($params) {
            foreach ($params as $prop => $value) {
                $key = [];
                if (Str::contains($prop, '.')) {
                    $key = explode('.', $prop);
                } else {
                    $key[0] = $prop;
                }
                if ($this->hasProperty($key[0])) {
                    if (isset($key[1])) {
                        $this->{$key[0]}[$key[1]] = $value;
                    } else {
                        $this->{$key[0]} = $value;
                    }
                    $key = implode('.', $key);
                    unset($params[$key]);
                }
            }
        }
        $this->params = $params;
    }

    protected function setTitle($title)
    {
        $this->title = $title;
    }

    public function setEditing($rowId)
    {
        $this->editing = $this->model::find($rowId);
        $this->fillEditingProps();
    }

    protected function fillEditingProps()
    {
        $props = $this->mergePropsWithFiles();
        foreach ($this->editing->only(array_keys($props)) as $key => $value) {
            if (array_key_exists($key, $this->files)) {
                $this->files[$key] = $value;
            } else {
                $this->props[$key] = $value;
            }
        }
    }

    public function setProperty($key, $value)
    {
        $this->props[$key] = $value;
    }

    protected function isDirty($prop)
    {
        return ($this->editing and $this->props[$prop] != $this->editing->$prop);
    }

    public function refresh(...$excepts)
    {
        $this->editing = null;
        $props = $this->mergePropsWithFiles();
        foreach ($props as $key => $value) {
            if (!in_array($key, $excepts)) {
                if (array_key_exists($key, $this->files)) {
                    $this->files[$key] = '';
                } else {
                    $this->props[$key] = '';
                }
            }
        }
    }
}
