<?php namespace Abs\ToDo\Controllers;

use Abs\ToDo\Models\Note;
use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendAuth;
use BackendMenu;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Input;
use October\Rain\Support\Facades\Flash;


class Notes extends Controller
{
    public $implement = [
        FormController::class,
        ListController::class
    ];

    public $formConfig = 'config_form.yaml';

    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['abs.todo.notes'];

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Управление заметками.';
        BackendMenu::setContext('Abs.ToDo', 'todo', 'notes');
    }

    public function index()
    {
        $this->makeLists();
        $this->makeView('index');
    }

    public function store()
    {
        $note = new Note;
        $note->title = Input::get('title');
        $note->description = Str::limit(Input::get('description', null), 500, '...');
        $note->user_id = BackendAuth::getUser()->id;

        if ($note->save()) {
            Flash::success('заметка: "' . $note->title . '" успешно добавлена !');
        } else {
            $messages = array_flatten($note->errors()->getMessages());
            $errors = implode('-', $messages);
            Flash::error('Ошибка валидаций: ' . $errors);
        }

        return Redirect::to(Backend::url('backend'));
    }

    public function update($recordId, $context = null)
    {
        return $this->asExtension('FormController')->update($recordId, $context);
    }

    public function formBeforeSave($model)
    {
        $model->user_id = BackendAuth::getUser()->id;
    }

    public function listExtendQueryBefore($query)
    {
        $user_id = BackendAuth::getUser()->id;
        $query->where('user_id', '=', $user_id);
    }

    public function listOverrideColumnValue($record, $columnName)
    {
        if ($columnName == "description" && empty($record->description)) return "";
    }

    /**
     * @param $list
     * добавить кнопку прочитанно.
     */
    public function listExtendColumns($list)
    {
        $list->addColumns([
            'action' => [
                'label' => 'прочитано',
                'sortable' => false
            ]
        ]);
    }
}
