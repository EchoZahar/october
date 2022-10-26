<?php namespace Abs\ToDo\FormWidgets;

use Backend\Classes\ReportWidgetBase;
use Backend\Facades\BackendAuth;

class QuickNoteWidget extends ReportWidgetBase
{
    public function render()
    {
        $notes = BackendAuth::getUser()->notes;
        trace_log($notes);
        return $this->makePartial('quicknotewidget', ['notes' => $notes]);
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title'     => 'Быстрые заметки',
                'default'   => 'Заметки',
            ],
            'showList' => [
                'title' => 'Показать записи',
                'type'  => 'checkbox',
            ],
        ];
    }
}
