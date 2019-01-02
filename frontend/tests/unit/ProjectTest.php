<?php
namespace frontend\tests;

use frontend\modules\projects\controllers\ProjectController;
use yii\data\ActiveDataProvider;

class ProjectTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected $id = 1;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testProject()
    {
        $model = ProjectController::findModel();
        $this->assertIsObject($model);
        $dataProvider = new ActiveDataProvider([
                'query' => $model,
        ]);
        $this->assertIsObject($dataProvider);
        $data = $dataProvider->query->all();

        if (is_array($data)) {
            foreach ($data as $object) {
                $this->assertIsArray($object->attributes);
                $this->assertArrayHasKey('projectName', $object->attributes);
                $this->assertArrayHasKey('project_status', $object->attributes);
                $this->assertArrayHasKey('description', $object->attributes);
                $this->assertArrayHasKey('responsible', $object->attributes);
            }
        } else if (is_object($data)) {
            $this->assertIsArray($data->attributes);
            $this->assertArrayHasKey('projectName', $data->attributes);
            $this->assertArrayHasKey('project_status', $data->attributes);
            $this->assertArrayHasKey('description', $data->attributes);
            $this->assertArrayHasKey('responsible', $data->attributes);
        }
    }

    public function testTask()
    {
        $id = $this->id;
        $model = ProjectController::findTask($id);
        $this->assertIsObject($model);
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
        ]);
        $this->assertIsObject($dataProvider);
        $data = $dataProvider->query->all();

        if (is_array($data)) {
            foreach ($data as $object) {
                $this->assertIsArray($object->attributes);
                $this->assertArrayHasKey('taskName', $object->attributes);
                $this->assertArrayHasKey('description', $object->attributes);
                $this->assertArrayHasKey('statusTask', $object->attributes);
                $this->assertArrayHasKey('namePerformer', $object->attributes);
                $this->assertArrayHasKey('priority', $object->attributes);
                $this->assertArrayHasKey('creator', $object->attributes);
                $this->assertArrayHasKey('dateCreate', $object->attributes);
                $this->assertArrayHasKey('dateDeadline', $object->attributes);
                $this->assertArrayHasKey('project_id', $object->attributes);
            }
        } else if (is_object($data)) {
            $this->assertIsArray($data->attributes);
            $this->assertArrayHasKey('taskName', $data->attributes);
            $this->assertArrayHasKey('description', $data->attributes);
            $this->assertArrayHasKey('statusTask', $data->attributes);
            $this->assertArrayHasKey('namePerformer', $data->attributes);
            $this->assertArrayHasKey('priority', $data->attributes);
            $this->assertArrayHasKey('creator', $data->attributes);
            $this->assertArrayHasKey('dateCreate', $data->attributes);
            $this->assertArrayHasKey('dateDeadline', $data->attributes);
            $this->assertArrayHasKey('project_id', $data->attributes);
        }
    }
}