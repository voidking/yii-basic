<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Project;

class ProjectController extends Controller
{
    public function actionAdd($title, $content){
        $project = new Project();
        $project->title = $title;
        $project->content = $content;
 
        $success = $project->save();
        if($success){
            $result = array(
                'code' => '0',
                'ext' => 'success'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }

    }

    public function actionEdit($id, $title, $content){
        $project = Project::find()->where(['id'=>$id])->one();
        $project->title = $title;
        $project->content = $content;
        $success = $project->save();

        if($success){
            $result = array(
                'code'=> '0',
                'ext'=> 'success'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else {
            $result = array(
                'code'=> '1',
                'ext'=> 'fail'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }

    public function actionDelete($id){
        $project = Project::find()->where(['id'=>$id])->one();
        $success = $project->delete();
        if($success){
            $result = array(
                'code'=> '0',
                'ext'=> 'success'
            );
            echo json_encode($result);
        }else {
            $result = array(
                'code'=> '1',
                'ext'=> 'fail'
            );
            echo json_encode($result);
        }
    }

    public function actionList(){
        $projectList = Project::find()->asArray()->all();
        $result = array(
                'code'=> '0',
                'ext'=> 'success',
                'projectList' => $projectList
        );
        echo json_encode($result,JSON_UNESCAPED_UNICODE);

    }

    public function actionPage($pageSize,$pageNum){
        $project = new Project();
        $total = $project->find()->count();
        $totalPage = $total%$pageSize ? (int)($total/$pageSize)+1 : (int)($total/$pageSize);

        $projectList = $project->find()->offset(($pageNum-1)*$pageSize)->limit($pageSize)->asArray()->all();
        
        if($projectList){
            $resultArr = array(
                'totalPage'=> $totalPage,
                'pageNum'=> $pageNum,
                'projectList'=> $projectList

            );
            $result = array(
                'code'=> '0',
                'ext'=> 'success',
                'obj'=> $resultArr
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }

    public function actionFind($id){
        $project = new Project();
        $item = $project->find()->where(['id'=>$id])->asArray()->one();
        $result = array(
            'code'=> '0',
            'ext'=> 'success',
            'obj'=> $item
        );
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
}

