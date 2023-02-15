<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    const ROLE_ADMIN = 1;

    const SCENARIO_CREATE = 'reset_create';

    const SCENARIO_RESET_PASSWORD = 'reset_password';

    const SCENARIO_UPDATE = 'update';

    public $changePassword;
    public $confirmPassword;

    private $password;

    /**
     * @return null|self
     */
    public static function current(): ?User
    {
        return \Yii::$app->user->identity;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by login
     *
     * @param string $login
     *
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * Finds user by login
     *
     * @param string $login
     *
     * @return static|null
     */
    public static function findByUsername(string $login)
    {
        return static::findByLogin($login);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['confirmPassword'], 'required', 'on' => self::SCENARIO_CREATE],
            [['login', 'email', 'role_id', 'password',], 'required', 'on' => self::SCENARIO_CREATE],

            [['confirmPassword'], 'required', 'on' => self::SCENARIO_RESET_PASSWORD],
            [['login', 'email', 'role_id', 'password',], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['login', 'email', 'role_id',], 'required', 'on' => self::SCENARIO_UPDATE],
            [['login'], 'string'],
            [['role_id',], 'integer', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_UPDATE]],
            [['email'], 'email'],
            [['login'], 'string', 'max' => 254, 'min' => 5],
            [['password'], 'string', 'min' => 6],
            [['changePassword'], 'string', 'min' => 6, 'on' => self::SCENARIO_RESET_PASSWORD],
            [['login'], 'unique'],
            [['changePassword', 'confirmPassword', 'password'], 'safe'],
        ];
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        if ($password) {
            $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
        }
        $this->generateAuthKey();
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->generateAuthKey();
            $this->generateToken();
        } else {
            if ( ! empty($this->changePassword)) {
                $this->setPassword($this->changePassword);
            }
        }

        return parent::beforeSave($insert);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->access_key = \Yii::$app->security->generateRandomString();
    }

    public function generateToken()
    {
        $this->access_token = \Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'              => Yii::t('app', 'ID'),
            'login'           => Yii::t('app', 'Login'),
            'email'           => Yii::t('app', 'Email'),
            'password'        => Yii::t('app', 'Password'),
            'confirmPassword' => Yii::t('app', 'Confirm password'),
            'role_id'         => Yii::t('app', 'Role'),
            'changePassword'  => Yii::t('app', 'Password'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->access_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     *
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function getUsername(): string {
        return $this->login;
    }
}
