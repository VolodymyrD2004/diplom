<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class CategoryImageForm extends Model
{

    /**
     * @var \app\models\Category
     */
    public $model;
    /**
     * @var UploadedFile
     */
    public $image;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['image',], 'file'],
            //[['image'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'image' => Yii::t('app', 'Image'),
        ];
    }

    public function upload(): bool
    {
        if ( ! $this->validate()) {
            return false;
        }

        $tempImageFilename = Yii::getAlias('@runtime') . DIRECTORY_SEPARATOR .
                             $this->image->baseName . '.' . $this->image->extension;
        if (!empty($this->model->image)) {
            $class = get_class($this->model);
            $class::bucket()->deleteFile($this->model->image);
        }

        $this->image->saveAs($tempImageFilename);
        return $this->model->moveImageIn($tempImageFilename);
    }
}
