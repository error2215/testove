<?php


namespace app\models;


use Yii;
use yii\base\Model;

class CvLoadForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, doc, docx'],
        ];
    }

    public function upload()
    {
        $name = pathinfo($this->file)['filename'];
        $extension = pathinfo($this->file)['extension'];

        if ($this->validate()) {

            $this->file->saveAs('cv/' . $name . '.' . $extension);
            $cv = new Cv();
            $cv->user_id = Yii::$app->user->identity->getId();
            $cv->name = $name;
            $cv->source = 'web/cv/' . $name . '.' . $extension;
            $cv->save();
            return true;
        } else {
            return false;
        }
    }
}