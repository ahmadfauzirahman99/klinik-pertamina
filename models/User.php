<?php

namespace app\models;

use Yii;
use app\models\pasien\Pasien;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    // const STATUS_DELETED = 0;
    // const STATUS_ACTIVE = 10;

    // /**
    //  * @inheritdoc
    //  */
    public static function tableName()
    {
        return 'users';
    }

    // public function rules()
    // {
    //     return [
    //         ['status', 'default', 'value' => self::STATUS_ACTIVE],
    //         ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
    //     ];
    // }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {

        return static::findOne([
            // 'no_identitas' => $id,
            'u_id' => $id,
            // 'status' => self::STATUS_ACTIVE
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne([
            'username' => $username,
            // 'status' => self::STATUS_ACTIVE
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->u_id;
        // return $this->no_identitas;
        // return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        // return Yii::$app->security->generateRandomString();
        return $this->nomor_telpn;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $password = md5($password);
        // var_dump($password);
        // var_dump($this->password);
        // exit;
        return $password == $this->password;
        // return Yii::$app->security->validatePassword($password, $this->tanggal_lahir);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->nomor_telpn = Yii::$app->security->generateRandomString();
    }

    
}
