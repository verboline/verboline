<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace console\controllers;

use Yii;

class RbacController extends \yii\console\Controller
{
    public function actionInit()
    {
         
          $auth = Yii::$app->authManager;
          
         
          //$rule = new \common\modules\users\AuthorRule;
          //  $auth->add($rule); 

            //$updateOwnPost = $auth->createPermission('updateOwnPost');
            //$updateOwnPost->description = 'update own post';
            //$updateOwnPost->ruleName = $rule->name;
            //$auth->add($updateOwnPost);
           // $authorRole=$auth->getRole('author');
           // $updateOwnPost=$auth->getPermission('updateOwnPost');
          //  $auth->addChild($authorRole, $updateOwnPost);
            /*
        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'create a post';
        $auth->add($createPost);
        
        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'update post';
        $auth->add($updatePost);
        
        // add "author" role and give this role the "createPost" permission
        // as well as the permissions of the "reader" role
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);
  */      
          
        $dictate = $auth->createPermission('dictate');
        $dictate->description = 'Administration';
        $auth->add($dictate);
        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $dictate);
       // $auth->addChild($admin, $author);
        
/*
        // add "readPost" permission
        $readPost = $auth->createPermission('readPost');
        $readPost->description = 'read a post';
        $auth->add($readPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'update post';
        $auth->add($updatePost);

        // add "reader" role and give this role the "readPost" permission
        $reader = $auth->createRole('reader');
        $auth->add($reader);
        $auth->addChild($reader, $readPost);

        // add "author" role and give this role the "createPost" permission
        // as well as the permissions of the "reader" role
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);
        $auth->addChild($author, $reader);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // Assign roles to users. 10, 14 and 26 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($reader, 10);
        $auth->assign($author, 14);
        $auth->assign($admin, 26);
 *  * 
 */
 
    }

}
?>
