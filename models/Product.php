<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii2tech\filestorage\BucketInterface;

/**
 * This is the model class for table "product".
 *
 * @property int         $id
 * @property string      $sku
 * @property int         $category_id
 * @property string      $title
 * @property float       $price
 * @property int         $quantity
 * @property int|null    $show
 * @property string      $brand_title
 * @property string|null $description
 * @property string|null $image
 * @property string      $url
 *
 * @property Category    $category
 * @property OrderItem[] $orderItems
 */
class Product extends \yii\db\ActiveRecord
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
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku', 'category_id', 'title', 'price', 'brand_title', 'url'], 'required'],
            [['category_id', 'quantity', 'show'], 'integer'],
            [['price'], 'number'],
            [['sku'], 'string', 'max' => 20],
            [['title', 'url'], 'string', 'max' => 254],
            [['brand_title'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 10000],
            [['image'], 'string', 'max' => 400],
            [['sku'], 'unique'],
            [['url'], 'unique'],
            [
                ['category_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Category::class,
                'targetAttribute' => ['category_id' => 'id'],
            ],
            [['imageFile',], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'sku'         => Yii::t('app', 'Sku'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title'       => Yii::t('app', 'Title'),
            'price'       => Yii::t('app', 'Price'),
            'quantity'    => Yii::t('app', 'Quantity'),
            'show'        => Yii::t('app', 'Show'),
            'brand_title' => Yii::t('app', 'Brand Title'),
            'description' => Yii::t('app', 'Description'),
            'image'       => Yii::t('app', 'Image'),
            'url'         => Yii::t('app', 'Url'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['product_id' => 'id']);
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

    public function getImageUrl(): string
    {
        return self::bucket()->getFileUrl($this->image);
    }

    public function getPublicUrl(): string
    {
        return \yii\helpers\Url::toRoute(['/store/product/index', 'id' => $this->id, 'url' => $this->url]);
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
}
