<?php

namespace app\models;

use http\Url;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii2tech\filestorage\BucketInterface;

/**
 * This is the model class for table "category".
 *
 * @property int         $id
 * @property string      $title
 * @property string      $url
 * @property string|null $image
 *
 * @property Product[]   $products
 */
class Category extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['title', 'url'], 'string', 'max' => 254],
            [['image'], 'string', 'max' => 400],
            [['title'], 'unique'],
            [['url'], 'unique'],
            [['imageFile',], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'    => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'url'   => Yii::t('app', 'Url'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    public function beforeDelete()
    {
        self::bucket()->deleteFile($this->image);

        return parent::beforeDelete();
    }

    /**
     * @return BucketInterface
     */
    public static function bucket(): BucketInterface
    {
        return Yii::$app->fileStorage->getBucket('images');
    }

    public function moveImageIn($file): bool
    {
        do {
            $filename = strtolower(self::randomString(15));
            $filename .= '.' . (FileHelper::getExtensionsByMimeType(FileHelper::getMimeTypeByExtension($file)))[0];
        } while (self::find()->where(['image' => $filename])->exists());

        if (self::bucket()->moveFileIn($file, $filename)) {
            $this->image = $filename;

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $len
     *
     * @return string
     * @throws \yii\base\Exception
     */
    public static function randomString($len)
    {
        $code = strtoupper(Yii::$app->security->generateRandomString($len));
        $code = preg_replace(['/_/', '/-/'], ['X', 'Z'], $code);

        return $code;
    }

    public function getImageUrl(): string
    {
        return self::bucket()->getFileUrl($this->image);
    }

    public function getPublicUrl(): string
    {
        return \yii\helpers\Url::toRoute(['/store/category/index', 'id' => $this->id, 'url' => $this->url]);
    }

    public function upload(): bool
    {
        if ( ! $this->imageFile) {
            return false;
        }
        if ( ! $this->validate()) {
            return false;
        }

        $tempImageFilename = Yii::getAlias('@runtime') . DIRECTORY_SEPARATOR .
                             $this->imageFile->baseName . '.' . $this->imageFile->extension;
        if ( ! empty($this->image)) {
            self::bucket()->deleteFile($this->image);
        }

        $this->imageFile->saveAs($tempImageFilename);

        return $this->moveImageIn($tempImageFilename);
    }

    public static function list(): array
    {
        return ArrayHelper::map(self::find()->orderBy('title')->all(), 'id', 'title');
    }
}
