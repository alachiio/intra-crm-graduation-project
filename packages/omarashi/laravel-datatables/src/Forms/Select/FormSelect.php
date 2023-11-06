<?php
namespace Omarashi\LaravelDatatables\Forms\Select;

use Omarashi\LaravelDatatables\Forms\ColumnForm;

class FormSelect extends ColumnForm
{
    protected array $options;

    public function __construct($options)
    {
        parent::__construct('select');
        $this->options = $options;
        $this->input['options'] = $options;
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
