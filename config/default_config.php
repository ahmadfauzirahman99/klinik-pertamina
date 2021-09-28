<?php

/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-04-22 19:23:42 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-28 11:27:54
 */

return [
    'definitions' => [
        yii\grid\GridView::class => [
            // 'class' => 'kartik\grid\GridView',
            // 'pjax'=>true,
            'tableOptions' => [
                'class' => 'table table-sm table-striped table-bordered table-hover'
            ],
            // 'pager' => [
            //     'class' => 'app\components\GridPager',
            // ],
        ],
        yii\grid\SerialColumn::class => [
            'headerOptions' => [
                // 'class' => 'bg-lightblue'
            ]
        ],
        yii\grid\DataColumn::class => [
            'filterInputOptions' => [
                'class' => 'form-control form-control-sm',
                'autocomplete' => 'off'
            ],
            'headerOptions' => [
                // 'class' => 'bg-lightblue'
            ],
            'contentOptions' => [
                // 'style' => 'white-space: nowrap;',
                // 'class' => 'action-column',
                'style' => 'overflow: hidden; text-overflow: ellipsis;',
            ]
        ],
        // yii\grid\ActionColumn::class => [
        //     'class' => 'app\components\ActionColumn',
        //     'headerOptions' => [
        //         // 'class' => 'bg-lightblue'
        //     ],
        //     'contentOptions' => [
        //         'class' => 'action-column',
        //         'style' => 'text-align: center;',
        //     ],
        // ],
        yii\bootstrap4\ActiveField::class => [
            'inputOptions' => ['class' => 'form-control form-control-sm', 'autocomplete' => 'off'],
        ],
        yii\widgets\DetailView::class => [
            'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
        ],
        kartik\date\DatePicker::class => [
            'options' => ['class' => 'form-control form-control-sm', 'placeholder' => 'Pilih...'],
            // 'removeButton' => false,
            'pluginOptions' => [
                'todayHighlight' => true,
                'todayBtn' => true,
                'autoclose' => true,
                'format' => 'dd-mm-yyyy'
            ]
        ],
        kartik\select2\Select2::class => [
            'theme' => 'bootstrap',
            'size' => 'sm',
        ],
        kartik\number\NumberControl::class => [
            'maskedInputOptions' => [
                // 'prefix' => 'Rp ',
                'groupSeparator' => '.',
                'radixPoint' => ',',
                'allowMinus' => false,
            ],
            'displayOptions' => ['class' => 'form-control form-control-sm kv-monospace'],
            'options' => [
                'type' => 'hidden',
                'label' => '<label>Saved Value: </label>',
                'class' => 'kv-saved',
                'readonly' => true,
                'tabindex' => 1000
            ],
            'saveInputContainer' => ['class' => 'kv-saved-cont'],
        ],
        app\components\number\KyNumber::class => [
            'maskedInputOptions' => [
                // 'prefix' => 'Rp ',
                // 'alias' => 'numeric',
                'positionCaretOnClick' => 'none',
                'groupSeparator' => '.',
                'radixPoint' => ',',
                'allowMinus' => true,
                'unmaskAsNumber' => true, // untuk ambil unmasked value sebagai number,
            ],
            'displayOptions' => ['class' => 'form-control form-control-sm', 'autocomplete' => 'off'],
            'options' => [
                'type' => 'hidden',
                // 'label' => '<label>Saved Value: </label>',
                'label' => null,
                'class' => 'kv-saved',
                'readonly' => true,
                'tabindex' => 1000
            ],
            'saveInputContainer' => ['class' => 'kv-saved-cont'],
        ],
        // kartik\daterange\DateRangePicker::class => [
        //     'useWithAddon' => true,
        //     // 'attribute' => 'sale_date',
        //     'convertFormat' => true,
        //     'presetDropdown' => true,
        //     'options' => [
        //         // 'id' => 'transaksipenjualansearch-sale_date-0',
        //         'placeholder' => 'Pilih...',
        //     ],
        //     'i18n' => [
        //         'class' => 'yii\i18n\PhpMessageSource',
        //         'basePath' => '@app/messages',
        //         'forceTranslation' => true
        //     ],
        //     'autoUpdateOnInit' => false,
        //     'containerTemplate' => '
        //         <div class="kv-drp-dropdown">
        //             <span class="left-ind">{pickerIcon}</span>
        //             <input type="text" readonly class="form-control form-control-sm range-value" value="{value}">
        //             <span class="right-ind kv-clear" style="" title="Clear">&times;</span>
        //             <span class="right-ind"><b class="caret"></b></span>
        //         </div>
        //         {input}
        //     ',
        //     'pluginOptions' => [
        //         'linkedCalendars' => false,
        //         'showDropdowns' => true,
        //         'timePicker' => false,
        //         'locale' => [
        //             // 'format' => 'Y-m-d'
        //             'format' => 'd-m-Y'
        //         ],
        //         'minYear' => (int) date('Y') - 10,
        //         'maxYear' => (int) date('Y') + 0,
        //     ],
        // ],

        // kartik\number\NumberControl::class => [
        //     'maskedInputOptions' => [
        //         // 'prefix' => 'Rp ',
        //         'groupSeparator' => '.',
        //         'radixPoint' => ',',
        //         'allowMinus' => false,
        //     ],
        //     'displayOptions' => ['class' => 'form-control form-control-sm kv-monospace'],
        //     'options' => [
        //         'type' => 'hidden',
        //         'label' => '<label>Saved Value: </label>',
        //         'class' => 'kv-saved',
        //         'readonly' => true,
        //         'tabindex' => 1000
        //     ],
        //     'saveInputContainer' => ['class' => 'kv-saved-cont'],
        // ],
        // app\components\number\KyNumber::class => [
        //     'maskedInputOptions' => [
        //         // 'prefix' => 'Rp ',
        //         // 'alias' => 'numeric',
        //         'positionCaretOnClick' => 'none',
        //         'groupSeparator' => '.',
        //         'radixPoint' => ',',
        //         'allowMinus' => true,
        //         'unmaskAsNumber' => true, // untuk ambil unmasked value sebagai number,
        //     ],
        //     'displayOptions' => ['class' => 'form-control form-control-sm', 'autocomplete' => 'off'],
        //     'options' => [
        //         'type' => 'hidden',
        //         // 'label' => '<label>Saved Value: </label>',
        //         'label' => null,
        //         'class' => 'kv-saved',
        //         'readonly' => true,
        //         'tabindex' => 1000
        //     ],
        //     'saveInputContainer' => ['class' => 'kv-saved-cont'],
        // ],
        // yii\bootstrap4\Modal::class => [
        //     'headerOptions' => [
        //         'class' => 'modal-header bg-pink',
        //     ]
        //     // 'options' => [
        //     //     // 'data-backdrop' => 'static',
        //     //     'class' => 'fade effect-slide-in-bottom',
        //     // ],
        // ],

        // yii\data\Pagination::class => [
        //     'pageSize' => 25,
        // ],

        // kartik\export\ExportMenu::class => [
        //     'columnSelectorMenuOptions' => [
        //         'class' => 'dropdown-menu-right'
        //     ],
        //     'dropdownOptions' => [
        //         'menuOptions' => [
        //             'class' => 'dropdown-menu-right'
        //         ]
        //     ],
        //     'krajeeDialogSettings' => [
        //         'overrideYiiConfirm' => false
        //     ]
        // ],
    ],
];
