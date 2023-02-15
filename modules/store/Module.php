<?php

namespace app\modules\store;

use app\models\Order;
use app\models\OrderItem;
use app\models\Product;
use Yii;
use yii\base\Exception;
use yii\console\Application;
use yii\db\Expression;
use yii\helpers\Json;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;

class Module extends \yii\base\Module
{

    public $layoutPath = '@app/modules/store/views/layouts';
    public $layout = 'main';

    public function beforeAction($action)
    {
        $requestCookies  = Yii::$app->request->cookies;
        $responseCookies = Yii::$app->response->cookies;

        $clientSID = $requestCookies->getValue('ClientSID');
        if (empty($clientSID)) {
            $clientSID = Yii::$app->security->generateRandomString(50);
            $responseCookies->add(
                new Cookie(
                    [
                        'name'  => 'ClientSID',
                        'value' => $clientSID,
                    ]
                )
            );
        }
        Yii::$app->cart->setClient($clientSID);

        if (Yii::$app->request->isPost) {

            $actionName = Yii::$app->request->post('action');
            if ($actionName == 'add-to-cart') {
                $quantity = Yii::$app->request->post('quantity') ?? 1;
                $productId = Yii::$app->request->post('productId');
                Yii::$app->cart->addProduct($productId, $quantity);
                Yii::$app->response->redirect(Yii::$app->request->referrer);
                return false;
            }
            if ($actionName == 'remove-from-cart') {
                $productId = Yii::$app->request->post('productId');
                Yii::$app->cart->removeProduct($productId);
                Yii::$app->response->redirect(Yii::$app->request->referrer);
                return false;
            }
            if ($actionName == 'remove-from-cart-all') {
                $productId = Yii::$app->request->post('productId');
                Yii::$app->cart->removeProduct($productId,true);
                Yii::$app->response->redirect(Yii::$app->request->referrer);
                return false;
            }
        }

        return parent::beforeAction($action);
    }

    public function init()
    {
        parent::init();

        $this->setConsoleControllerNamespace();
    }

    protected function setConsoleControllerNamespace()
    {
        if (Yii::$app instanceof Application) {
            $this->controllerNamespace = __NAMESPACE__ . '\commands';
        }
    }
}