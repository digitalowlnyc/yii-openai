<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\QuestionForm;
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

	public function actionIndex()
	{
		$model = new QuestionForm();
		if ($model->load(Yii::$app->request->post())) {
			Yii::$app->session->setFlash('questionFormSubmitted');
			$modelResponse = $this->callOpenAI($model->question);
			Yii::$app->session->setFlash('questionAnswer', $modelResponse);

			return $this->refresh();
		}
		return $this->render('ask', [
			'model' => $model,
		]);
	}

    /**
     * Displays homepage.
     *
     * @return Response
	 */
    public function actionCall()
    {
		$modelResponse = $this->callOpenAI('Write a short 5 word bedtime story.');

		$responseData = [
			'response' => $modelResponse
		];

		return $this->asJson($responseData);
    }

	private function callOpenAI($prompt) {
		$OPENAI_API_KEY = Yii::$app->params['OPENAI_API_KEY'];

		$client = new GuzzleClient();

		$requestData = [
			'model' => 'gpt-5',
			'input' => $prompt
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

		return $modelResponse;
	}
}
