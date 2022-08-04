<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;
use hoaaah\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderLabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Lab';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>

<?= $this->render('../pemeriksaan-pasien/item-pemeriksaan') ?>
<div class="order-lab-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'tableOptions' => [
                'class' => 'table table-sm table-bordered table-hover table-list-item'
            ],
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                [
                    'content' =>
                    Html::a(
                        '<i class="fa fa-plus"></i>',
                        ['create'],
                        ['role' => 'modal-remote', 'title' => 'Create new Order Labs', 'class' => 'btn btn-primary btn-trans']
                    ) .
                        Html::a(
                            '<i class="fa fa-repeat"></i>',
                            [''],
                            ['data-pjax' => 1, 'class' => 'btn btn-warning btn-trans', 'title' => 'Reset Grid']
                        )
                    // '{toggleData}'
                    // '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="fa fa-list"></i> Order Labs listing',
                // 'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after' => BulkButtonWidget::widget([
                    'buttons' => Html::a(
                        '<i class="fa fa-trash"></i>&nbsp; Delete All',
                        ["bulkdelete"],
                        [
                            "class" => "btn btn-danger btn-xs",
                            'role' => 'modal-remote-bulk',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => 'Are you sure?',
                            'data-confirm-message' => 'Are you sure want to delete this item'
                        ]
                    ),
                ]) .
                    '<div class="clearfix"></div>',
            ]
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    'size' => Modal::SIZE_EXTRA_LARGE,
    "footer" => "", // always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>