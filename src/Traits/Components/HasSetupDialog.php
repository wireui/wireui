<?php

namespace WireUi\Traits\Components;

use WireUi\Actions\Dialog;

trait HasSetupDialog
{
    public mixed $id = null;

    public mixed $title = null;

    public mixed $dialog = null;

    public mixed $description = null;

    protected function setupDialog(array &$component): void
    {
        $this->id = $this->data->get('id');

        $this->title = $this->data->get('title');

        $this->dialog = Dialog::makeEventName($this->id);

        $this->description = $this->data->get('description');

        $this->setDialogVariables($component);

        $this->smart(['id', 'title', 'dialog', 'description']);
    }

    private function setDialogVariables(array &$component): void
    {
        $component['id'] = $this->id;

        $component['title'] = $this->title;

        $component['dialog'] = $this->dialog;

        $component['description'] = $this->description;
    }
}
