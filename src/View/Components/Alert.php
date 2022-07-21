<?php

namespace WireUi\View\Components;

class Alert extends BaseAlert
{
    public function getDefaultStyle()
    {
        if ($this->info) {
            $this->icon = (!$this->icon) ? 'information-circle' : $this->icon;
            $this->backgroundColor = 'bg-blue-50 dark:bg-blue-200';
            $this->subjectColor = 'text-blue-700 dark:text-blue-800';
            return true;
        }

        if ($this->warning) {
            $this->icon = (!$this->icon) ? 'exclamation' : $this->icon;
            $this->backgroundColor = 'bg-yellow-50 dark:bg-yellow-200';
            $this->subjectColor = 'text-yellow-700 dark:text-yellow-800';
            return true;
        }

        if ($this->positive) {
            $this->icon = (!$this->icon) ? 'check-circle' : $this->icon;
            $this->backgroundColor = 'bg-green-50 dark:bg-green-200';
            $this->subjectColor = 'text-green-700 dark:text-green-800';
            return true;
        }

        if ($this->negative) {
            $this->icon = (!$this->icon) ? 'x-circle' : $this->icon;
            $this->backgroundColor = 'bg-red-50 dark:bg-red-200';
            $this->subjectColor = 'text-red-700 dark:text-red-800';
            return true;
        }
    }
}
