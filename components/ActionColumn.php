<?php

namespace app\components;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{

    public $headerOptions = [
        'class' => 'action-column',
        'style' => 'min-width: 140px; text-align: center;'
    ];

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'list');
        $this->initDefaultButton('update', 'pencil');
        $this->initDefaultButton('delete', 'trash', [
            'data-confirm' => Yii::t('yii', 'Apakah Anda Yakin Ingin Menghapus Item Ini?'),
            'data-method' => 'post',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        $class = 'btn btn-info btn-rounded btn-sm btn-trans btn-icon';
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        $class = 'btn btn-warning btn-rounded btn-sm btn-trans btn-icon';
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        $class = 'btn btn-danger btn-rounded btn-sm btn-trans btn-icon';
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'class' => $class,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => "fa fa-$iconName"]);
                return Html::a($icon, $url, $options);
            };
        }
    }
}
