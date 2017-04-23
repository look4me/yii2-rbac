<?php
namespace backend\controllers;
/**
 * Created by PhpStorm.
 * User: look4me
 * Date: 2017/4/9
 * Time: 23:07
 */

use Yii;
use yii\web\Controller;

class RoleController extends Controller
{
    /**
     * 是否拥有创建权限
     */
    public function actionCancreate()
    {
        if (Yii::$app->user->can('createPost')) {
            return '有权限建贴';
        }else{
            return '无权限建贴';
        }
    }

    /**
     * 是否拥有更新权限
     */
    public function actionCanupdate()
    {
//        if (Yii::$app->user->can('updatePost', ['post' => $post])) {
        if (Yii::$app->user->can('updatePost')) {
            return '有权限更新帖子';
        }else{
            return '无权限更新帖子';
        }
    }

}