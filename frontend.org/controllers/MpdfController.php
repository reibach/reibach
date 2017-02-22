<?php
namespace frontend\controllers;
 
use Yii;
use yii\web\Controller;
use kartik\mpdf\Pdf;
use yii\helpers\Url;
 
class MpdfController extends Controller
{
    public function actionReport() {
 
        // get your HTML raw content without any layouts or scripts
        $content = "
            <b style='color:red'>bold</b>
            <img src='".Url::to('@web/images/reibach-logo-460x460.png', true)."'/>
            <a href='http://reibach.federa.de'>Reibach ...</a>
            ";
         
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content, 
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
             // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['THIS IS REPORT'],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
 
        // http response
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
 
        // return the pdf output as per the destination setting
        return $pdf->render();
    }
}
