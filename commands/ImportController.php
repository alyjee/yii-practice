<?php

namespace app\commands;

use Yii;
use yii\helpers\Json;

class ImportController extends \yii\console\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLoans()
    {
        return $this->render('loans');
    }

    public function actionUsers($filePath='/users.json')
    {
        $testCompletePath = '/app/test_users.json';
        Yii::$app->db->createCommand("COPY users FROM '$testCompletePath'")->execute();
        
        $user = Yii::$app->db->createCommand("select * from user")->queryAll();
        echo json_encode($user). "\n";
        
        return;
        $fileCompletePath = Yii::$app->basePath.$filePath;
        $data = Json::decode(file_get_contents($fileCompletePath), true);
        echo $data[0]['first_name']. "\n";
        Yii::$app->db->createCommand("COPY users FROM '$fileCompletePath'")->execute();
        echo "Message from users. \n";
        // "Copy tableName From file"
        // "Yii::$app->db->createCommand('UPDATE post SET status=1 WHERE id=1')->execute();"
    }

}
