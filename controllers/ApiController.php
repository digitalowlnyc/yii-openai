<?php

namespace app\controllers;

use GuzzleHttp\Client as GuzzleClient;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
        ];
    }

    /**
     * Displays homepage.
     *
     * @return Response
	 */
    public function actionCall()
    {
		$OPENAI_API_KEY = Yii::$app->params['OPENAI_API_KEY'];

		$client = new GuzzleClient();

		$requestData = [
			'model' => 'gpt-5',
    		'input' => 'Write a short 5 word bedtime story.'
		];

		$res = $client->request('POST', 'https://api.openai.com/v1/responses', [
			'json' => $requestData,
			'headers' => [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $OPENAI_API_KEY,
			],
		]);

		$data = json_decode($res->getBody()->getContents(), true);

		$modelResponse = '';
		foreach($data['output'] as $output) {
			if($output['type'] === 'message') {
				$modelResponse = $output['content'][0]['text'];
			}
		}

		$responseData = [
			'response' => $modelResponse
		];

		return $this->asJson($responseData);
    }
}
