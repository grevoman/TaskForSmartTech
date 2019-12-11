<?php

namespace app\modules\parseKgdGovKz\controllers;

use yii\web\Controller;
use app\modules\parseKgdGovKz\models\BinIinForm;
use app\modules\parseKgdGovKz\models\SaveDataForm;
use app\modules\parseKgdGovKz\interfaces\WebPageParserInterface;
use app\modules\parseKgdGovKz\interfaces\ResolveCaptchaInterface;
use app\modules\parseKgdGovKz\interfaces\UidInterface;
use app\modules\parseKgdGovKz\interfaces\DataBehindCaptchaInterface;
use app\modules\parseKgdGovKz\interfaces\DbOperationsInterface;
use app\modules\parseKgdGovKz\models\CaptchaImageToText;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use app\modules\parseKgdGovKz\models\Identificator;
use app\modules\parseKgdGovKz\models\IdentificatorSearch;

/**
 * Default controller for the `parseKgdGovKz` module
 */
class DefaultController extends Controller
{
    public $module = '';
    private $resolveCaptcha;
    private $uidManipulations;
    private $DataBehindCaptcha;
    private $dbOperations;

    public function __construct(
            $id,
            $module,
            ResolveCaptchaInterface $resolveCaptcha,
            UidInterface $uidManipulations,
            DataBehindCaptchaInterface $DataBehindCaptcha,
            DbOperationsInterface $dbOperations,
            $config = []
    ) {
        $this->module = $module;
        $this->resolveCaptcha = $resolveCaptcha;
        $this->uidManipulations = $uidManipulations;
        $this->DataBehindCaptcha = $DataBehindCaptcha;
        $this->dbOperations = $dbOperations;
        parent::__construct($id, $module, $config);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $modelBinIinForm = new BinIinForm();
        $modelSaveDataForm = new SaveDataForm();
        $resultArray = '';
        $resultJson = '';

        if ($modelSaveDataForm->load(\Yii::$app->request->post()) && $modelSaveDataForm->validate()) {
            if ($taxArrearJsonData = \Yii::$app->cache->get($modelSaveDataForm->iinBin)) {
                $this->dbOperations->saveTaxArrearDataFromSite($taxArrearJsonData);
            }
        }

        if ($modelBinIinForm->load(\Yii::$app->request->post()) && $modelBinIinForm->validate()) {
            $uuid = $this->uidManipulations->GenerateUID();
            $captchaImg = $this->resolveCaptcha->getCaptchaImage($this->module->getCaptchaUrl . '?uid=' . $uuid . '&t=' . $this->uidManipulations->GenerateUID());
            $captchaText = $this->resolveCaptcha->getTextOfCaptchaFromImage($captchaImg, $this->module->apiKey);
            unlink($captchaImg);
            $resultJson = $this->DataBehindCaptcha->getData($uuid, $modelBinIinForm->biniin, $captchaText, $this->module->searchUrl);

            // Используется для локальной отладки, при этом надо закомментировать процесс получения данных из сети Интернет
            //$resultJson = file_get_contents(\Yii::$app->runtimePath . '/response.json');

            try {
                $resultArray = Json::decode($resultJson, true);
                \Yii::$app->cache->set($modelBinIinForm->biniin, $resultJson);
            } catch (Exception $ex) {
                Yii::warning("Ошибка обработки ответа сервера");
            }
        }
        return $this->render('index',
                        [
                            'modelBinIinForm' => $modelBinIinForm,
                            'resultArray' => $resultArray,
                            'resultJson' => $resultJson,
                            'modelSaveDataForm' => $modelSaveDataForm,
                        ]
        );
    }

    /**
     * Формирует страницу вывода сохранённых в базе данных
     * 
     * @return string
     */
    public function actionShowSavedData() {
        $searchModel = new IdentificatorSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('showSavedData', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Identificator model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetailView($id) {
        return $this->render('view', [
                    'model' => $this->findModel((int) $id),
        ]);
    }

    /**
     * Finds the Identificator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Identificator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Identificator::find()->where(['id' => $id])->with('commonInfo.taxOrgInfo.taxPayerInfo.bccArrearsInfo')->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}