<?php

namespace console\controllers;

use Yii;

class RolesController extends \yii\console\Controller {
   
    public function actionRoot($userId)
    {
            if ($userId==null)
                return;
            else {
                $auth = Yii::$app->authManager;
                $admin = $auth->getRole('admin');
                $auth->assign($admin, $userId);
            }
    }
}

?>
