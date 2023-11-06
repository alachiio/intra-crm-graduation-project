<?php
namespace Omarashi\LaravelDatatables\Forms;

abstract class ColumnForm
{
    protected string $type;
    protected array $input;

    public function __construct($type)
    {
        $this->type = $type;
        $this->input['type'] = $type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public static function create(...$props) : array
    {
        $form = new static(...$props);
        return $form->input;
    }
}
