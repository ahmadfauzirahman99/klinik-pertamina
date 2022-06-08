<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $u_id
 * @property string $username
 * @property string $nama_lengkap
 * @property string|null $password
 * @property string|null $email
 * @property string|null $tgl_pendaftaran
 * @property string|null $verif
 * @property string|null $nomor_telpn
 */
class Pengguna extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'nama_lengkap'], 'required'],
            [['password'], 'string'],
            [['tgl_pendaftaran'], 'safe'],
            [['username', 'nama_lengkap', 'email', 'verif', 'nomor_telpn'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'u_id' => 'U ID',
            'username' => 'Username',
            'nama_lengkap' => 'Nama Lengkap',
            'password' => 'Password',
            'email' => 'Email',
            'tgl_pendaftaran' => 'Tgl Pendaftaran',
            'verif' => 'Verif',
            'nomor_telpn' => 'Nomor Telpn',
        ];
    }
}
