<?php
namespace console\controllers;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionIndex()
    {
        $am = \Yii::$app->authManager;

        $admin = $am->createRole('admin');
        $projectManager = $am->createRole('projectManager');

        $am->add($admin);
        $am->add($projectManager);

        $permissionCreate = $am->createPermission('createTask');
        $permissionUpdate = $am->createPermission('updateTask');
        $permissionDelete = $am->createPermission('deleteTask');

        $am->add($permissionCreate);
        $am->add($permissionUpdate);
        $am->add($permissionDelete);

        $am->addChild($admin,$permissionCreate);
        $am->addChild($admin,$permissionUpdate);
        $am->addChild($admin,$permissionDelete);

        $am->addChild($projectManager,$permissionCreate);

        $am->assign($admin,1);
        $am->assign($projectManager,2);
    }
}