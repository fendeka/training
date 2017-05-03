<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Input;
use app\core\Helper;
use app\core\Config;
use app\models\Task;
use app\tools\Image;

class TaskController extends Controller
{

    public $image;
    public $task;

    public function __construct($controller, array $params = [])
    {
        parent::__construct($controller, $params);
        $this->image = new Image();
        $this->task = new Task();

    }

    public function actionIndex($column = 'username', $order = 'ASC', $start = 1)
    {
        $this->set('title', 'Tasks');
        $pagination_params = $this->task->getPaginationParams($start);
        $this->set('params',[
            'order' => $this->task->getSortingOrder(strtoupper($order)),
            'current_order' => strtoupper($order),
            'pagination' => $pagination_params,
            'column' => $column,
        ]);
        $this->set('tasks', $this->task->getTasks($column, $order, $pagination_params['start_item'], Config::get('pagination/per_page')));
    }

    public function actionCreate()
    {
        $this->set('title', 'Create Task');
        $this->task->validation_rules = $this->task->scenario['task'];
        if (Input::isPost()) {
            $this->task->validate(Input::getPost());
            if ($this->task->validation) {
                $this->set('errors', $this->task->getErrors());
            } else {
                $this->task->saveTaskImage($this->task, $this->image);
            }
        }
    }

    public function actionUpdate($id)
    {
        $this->set('title', 'Update Task');
        $this->task->validation_rules = $this->task->scenario['task'];
        if (Input::isPost()) {
            $this->task->validate(Input::getPost());
            if ($this->task->validation) {
                $this->set('errors', $this->task->getErrors());
            } else {
                $data = $this->task->findTaskById($id);
                $this->image->file_name = $data['image'];
                $this->task->saveTaskImage($this->task, $this->image, $id);
            }
        }
        $this->set('data', $this->task->findTaskById($id));
    }

    public function actionDelete($id)
    {
        $this->set('title', 'Delete Task');

        if (Input::isPost()) {
            $item = $this->task->findTaskById($id);
            if($this->task->deleteRecord(['id', '=', $id])){
                if(is_file(Config::get('image/path').$item['image'])){
                    unlink(Config::get('image/path').$item['image']);
                }
                Helper::redirect('/task');
            }
        }
        $this->set('id', $id);
    }

    public function actionError()
    {
        $this->set('title', 'Error');
    }
}
