<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\campaign\models\Sicoobcard;
use app\models\User;

$this->title = 'Campanha Sicoobcard Todo Dia';
?>
<div class="campaign-sicoobcard-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;">
      <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
      </span></div>
    </div>
    <hr/>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>
    
    <div class="panel panel-default">
        <div class="panel-body">     
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                  'attribute' => 'id',
                  'enableSorting' => true,
                  'contentOptions'=>['style'=>'width: 4%;text-align:center'],
                ], 
                [
                  'attribute' => 'product_type',
                  'enableSorting' => true,
                  'value' => function($data) {
                      return $data->getProductType();
                  },
                  'filter' => Sicoobcard::$Static_product_type,
                  'contentOptions'=>['style'=>'width: 10%;text-align:center'],
                ],                            
                'name',
                'card',
                [
                  'attribute' => 'purchasedate',
                  'enableSorting' => true,
                  'contentOptions'=>['style'=>'width: 5%;text-align:center'],
                  'format' => ['date', 'php:d/m/Y'],
                ],                  
                'purchasevalue',
                [
                  'attribute' => 'user_id',
                  'format' => 'raw',
                  'enableSorting' => true,
                  'value' => function ($model) {                      
                      return $model->user ? $model->user->username : '<span class="text-danger"><em>Nenhum</em></span>';
                  },
                  'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                  'contentOptions'=>['style'=>'width: 8%;text-align:left'],
                ],
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',  
                'contentOptions'=>['style'=>'width: 10%;text-align:right'],
                'headerOptions' => ['class' => 'text-center'],                            
                'template' => '{view} {update} {delete}',
                'buttons' => [
                               
                      'view' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-list-alt" ></span>', $url, [
                                      'title' => 'Detalhes',
                                      'class' => 'btn btn-default btn-xs',
                          ]);
                      },                                                
                      'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil" ></span>', $url, [
                                      'title' => 'Alterar',
                                      'class' => 'btn btn-default btn-xs',
                          ]);
                      },
                      'delete' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-trash" ></span>', $url, [
                                      'title' => 'Excluir',
                                      'class' => 'btn btn-default btn-xs',
                                      'data-confirm' => 'Tem certeza que deseja excluir?',
                                      'data-method' => 'post',
                                      'data-pjax' => '0',
                          ]);
                      },                                    
                    ],                
              ],
            ],
        ]); ?>
        </div>
    </div>
</div>