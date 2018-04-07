<?php

namespace frontend\controllers;

use app\models\Task;
use app\models\TaskContainer;
use frontend\components\Modal;
use Yii;
use app\models\Project;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\View;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userProjects = Project::findAll(['user_id' => Yii::$app->user->id]);
        return $this->render('index', [
            'userProjects' => $userProjects,
        ]);
    }

    public function actionTest()
    {
        return $this->render('create_modal', []);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $userTaskContainers = TaskContainer::findAll(['user_id' => Yii::$app->user->id, 'project_id' => Yii::$app->request->get('id')]);
        $projectUserTasks = Task::findAll(['user_id' => Yii::$app->user->id, 'project_id' => Yii::$app->request->get('id')]);
        $projectUserTasksByContainer = [];
        foreach ($projectUserTasks as $task) {
            $task = $task->toArray();
            if (empty($projectUserTasksByContainer[$task['id']])) {
                $projectUserTasksByContainer[$task['id']] = [];
            }
            array_push($projectUserTasksByContainer[$task['id']], $task);
        }

        $model = $this->findModel($id);
        $modelProjectParent = $model->getParentProject();
        $modelProjectChild = $model->getChildProjects();

        $updateProjectModal = Modal::renderModal('update-project-modal', '//project/update_modal', [
            'model' => $model
        ]);
        $createContainerModal = Modal::renderModal('create-container-modal', '//task-container/create_modal', [
            'model' => new TaskContainer()
        ]);
        $updateContainerModal = Modal::renderModal('update-container-modal', '//task-container/update_modal', [
            'model' => TaskContainer::findOne(['id' => Yii::$app->request->get('task_container_id')])
        ]);
        $createTaskModal = Modal::renderModal('create-task-modal', '//task/create_modal', [
            'model' => new Task()
        ]);;

        return $this->render('view', [
            'model' => $model,
            'modelProjectParent' => $modelProjectParent,
            'modelProjectChild' => $modelProjectChild,
            'userTaskContainers' => $userTaskContainers,
            'projectUserTasksByContainer' => $projectUserTasksByContainer,
            'parentProject' => $modelProjectParent->one(),
            'childProjects' => $modelProjectChild->all(),
            'updateProjectModal' => $updateProjectModal,
            'createContainerModal' => $createContainerModal,
            'updateContainerModal' => $updateContainerModal,
            'createTaskModal' => $createTaskModal,
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['//site/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['//site/index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionTime()
    {
        return $this->render('time-date', ['response' => date('H:i:s')]);
    }
    public function actionDate()
    {
        return $this->render('time-date', ['response' => date('d.m.Y')]);
    }
}
