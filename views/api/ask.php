<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Ask AI';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
	<h1><?= Html::encode($this->title) ?></h1>

	<?php if (Yii::$app->session->hasFlash('questionFormSubmitted')): ?>

		<div class="alert alert-success">
			Here is your answer: <?= Yii::$app->session->getFlash('questionAnswer') ?>
		</div>

	<?php else: ?>

		<p>
			What would you like to ask?
		</p>

		<div class="row">
			<div class="col-lg-5">

				<?php $form = ActiveForm::begin(['id' => 'question-form']); ?>

				<?= $form->field($model, 'question')->textarea(['rows' => 6, 'value' => 'Write me a 10 word story.']) ?>

				<div class="form-group">
					<?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
				</div>

				<?php ActiveForm::end(); ?>

			</div>
		</div>

	<?php endif; ?>
</div>
