<?php

namespace app\models;

use yii\base\Model;

/**
 * QuestionForm is the model behind the question form.
 */
class QuestionForm extends Model
{
    public $question;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['question'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
        ];
    }
}
