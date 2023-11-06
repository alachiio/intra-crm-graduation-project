<?php

use App\Models\LanguageLine;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helper
{
    public static function getPageName()
    {
        if (request()->route()) {
            return request()->route()->getName();
        }
        return null;
    }
}

if (!function_exists('i18n')) {
    function i18n($string, $placeholders): string
    {
        $string = __($string);
        foreach ($placeholders as $key => $value) {
            $string = str_replace('{{' . $key . '}}', $value, $string);
        }
        return $string;
    }
}

if (!function_exists('locale')) {
    function locale()
    {
        return app()->getLocale();
    }
}

if (!function_exists('languages')) {
    function languages(): array
    {
        return config('project.languages');
    }
}

if (!function_exists('current_lang')) {
    function current_lang($key = 'locale')
    {
        return Arr::first(languages(), function ($value) {
                return $value['locale'] == app()->getLocale();
            })[$key] ?? '';
    }
}

if (!function_exists('languagesDropdown')) {
    function languagesDropdown(): array
    {
        return Arr::pluck(languages(), 'native', 'locale');
    }
}

if (!function_exists('locales')) {
    function locales(): array
    {
        return Arr::pluck(languages(), 'locale');
    }
}

if (!function_exists('locales_init')) {
    function locales_init(): array
    {
        return Arr::pluck(languages(), '', 'locale');
    }
}

if (!function_exists('default_lang')) {
    function default_lang($key = 'locale')
    {
        return Arr::first(languages(), function ($value) {
                return $value['locale'] == config('project.default_locale');
            })[$key] ?? '';
    }
}

if (!function_exists('next_locale')) {
    function next_locale($index)
    {
        return ($index < (count(languages()) - 1)) ? languages()[$index + 1]['locale'] : languages()[$index]['locale'];
    }
}

if (!function_exists('next_locale_input')) {
    function next_locale_input($index)
    {
        $result = "";
        if ($index < (count(languages()) - 1)) {
            $index += 1;
            $result = "event.preventDefault();";
        }
        $locale = languages()[$index]['locale'];
        $result .= "locale = '" . $locale . "';";

        return $result;
    }
}

if (!function_exists('validation_attributes')) {
    function validation_attributes(): array
    {
        return [

        ];
    }
}

if (!function_exists('toast')) {
    function toast($icon, $message)
    {
        session()->flash('toast', ['icon' => $icon, 'message' => $message]);
    }
}

if (!function_exists('doFileUpload')) {
    function doFileUpload($file, $oldFile, $folder, $driver = 'public')
    {
        //check file if is not null and not string (update status) store it and return it
        if ($file) {
            if (is_string($file)) {
                return $file;
            }
            $temp = $file;
            if ($oldFile)
                Storage::disk($driver)->delete($oldFile);
            $file = $file->store($folder, $driver);
            $temp->delete();
            return 'storage/' . $file;
        }
        return null;
    }
}

if (!function_exists('storeBase64File')) {
    function storeBase64File($file, $folder, $name, $driver = 'public')
    {
        $decoded = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));

        $finfo = finfo_open();
        $mimeType = finfo_buffer($finfo, $decoded, FILEINFO_MIME_TYPE);
        finfo_close($finfo);

        $fileName = $folder . '/' . $name . '.' . explode('/', $mimeType)[1];
        Storage::disk($driver)->put($fileName, $decoded);

        return 'storage/' . $fileName;
    }
}

if (!function_exists('getUrlSection')) {
    function getUrlSection($offset)
    {
        return explode('/', request()->getRequestUri())[$offset] ?? '';
    }
}

if (!function_exists('getTranslationGroupsDropdown')) {
    function getTranslationGroupsDropdown()
    {
        return LanguageLine::pluck('group', 'group')->unique();
    }
}

if (!function_exists('getModels')) {
    function getModels()
    {
        return config('project.models');
    }
}


