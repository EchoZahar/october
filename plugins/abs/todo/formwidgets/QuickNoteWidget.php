<?php namespace Abs\ToDo\FormWidgets;

use Abs\ToDo\Models\Note;
use Backend\Classes\ReportWidgetBase;
use Backend\Facades\BackendAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use October\Rain\Support\Facades\Flash;

class QuickNoteWidget extends ReportWidgetBase
{
    public function defineProperties()
    {
        return [
            'title' => [
                'title' => 'Быстрые заметки',
                'default' => 'Заметки',
            ],
            'showList' => [
                'title' => 'Показать записи',
                'type' => 'checkbox',
            ],
        ];
    }

    public function onCreate()
    {
        $note = new Note;
        $note->title = input('title');
        $note->description = Str::limit(input('description', null), 500, '...');
        $note->user_id = BackendAuth::getUser()->id;
        if ($note->save()) {
            Flash::success('заметка: "' . $note->title . '" успешно добавлена !');
        } else {
            $messages = array_flatten($note->errors()->getMessages());
            $errors = implode('-', $messages);
            Flash::error('Ошибка валидаций: ' . $errors);
        }
        return ['#notes_widget' => $this->render()];
    }

    public function render()
    {
        $notes = BackendAuth::getUser()->notes;
        return $this->makePartial('quicknotewidget', ['notes' => $notes]);
    }

    public function onDelete(Request $request)
    {
        $note = Note::where('id', intval($request->input('noteID')))
            ->where('user_id', BackendAuth::getUser()->id)
            ->firstOrFail();
        if ($note) {
            $note->delete();
            Flash::success('Заметка: "' . $note->title . '" успешно удалена.');
        } else {
            Flash::error('Что то пошло не так. Обновите страницу и попробуйте еще раз !');
        }
        return ['#notes_widget' => $this->render()];
    }
}
