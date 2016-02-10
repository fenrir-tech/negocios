<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = "Detalhes da visita #" . $model->id;
?>
<div class="visits-view">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <p class="pull-right">
                    <?= Html::a('<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir', '#', ['onclick'=>"myFunction()",'class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Enviar Fotos', ['/visitsimages/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Tem certeza que deseja excluir?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
        </div>
    
    </div>

    <div class="row container-fluid">
    <div class="panel panel-primary">
    <div class="panel-heading"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> <strong>Informações da Visita</strong></div>
    <div class="panel-body">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [ 
                        'label' => 'Data',
                        'format' => 'raw',
                        'value' => date("d/m/Y",  strtotime($model->date))
                    ],
                    'company_person',
                    'responsible',
                    
                    'contact',
                    'email:email',
                    'phone',
                    [ 
                        'label' => 'Valor',
                        'format' => 'raw',
                        'value' => "R$ ".$model->value,
                    ],   
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [ 
                    [ 
                    'label' => 'Usuário',
                    'format' => 'raw',
                    'value' => $model->user->username,
                    ],  
                    'location.fullname',                     
                    'visitsFinality.name',
                    'person.name', 
                    'num_proposal',
                    [
                   'attribute'=>'attachment',
                   'format' => 'raw',
                   'value' => $model->attachment == null ? "<span class=\"not-set\">(sem anexo)</span>" : '<span class="glyphicon glyphicon-paperclip"></span> '.Html::a('Visualizar Anexo', Yii::$app->request->baseUrl."/attachment/".$model->attachment, ['target' => '_blank']),
                    ], 
                    [ 
                    'label' => 'Situação',
                    'format' => 'raw',
                    'value' => "<strong style=\"color:".$model->visitsStatus->hexcolor."\">" . $model->visitsStatus->name . "</strong>",
                    ],                                         
                ],
            ]) ?>
        </div>
    </div>
    </div>
    </div>

    <div class="row container-fluid">
        <div class="panel panel-primary">
          <div class="panel-heading"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <strong>Parecer do Gerente</strong></div>
          <div class="panel-body">
            <?php echo $model->observation;?>
          </div>
        </div>
    </div> 

    <div class="row container-fluid">
        <div class="panel panel-primary">
          <div class="panel-heading"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <strong>Imagens da Visita</strong></div>
          <div class="panel-body">
            (imagens)
          </div>
        </div>
    </div>

    <div class="row container-fluid">
        <div class="panel panel-primary">
          <div class="panel-heading"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <strong>Mapa da Localização</strong></div>
          <div class="panel-body">
            <?php
            use tugmaks\GoogleMaps\Map;

            echo Map::widget([
                'apiKey'=> 'AIzaSyDu0tafuRLYW1BW7OgMe7CuFIDAwCXS4A0',
                'zoom' => 16,
                'center'=>'rua belo horizonte 761 centro, governador valadares',
                'width' => 900,
                'height' => 400,
                'mapType' => Map::MAP_TYPE_ROADMAP,
                'markers' => [
                    ['position' => 'Hotel Master'],
                ]
            ]);
            ?>
          </div>
        </div>
    </div>  

    <div class="row container-fluid">
        <div class="panel panel-primary">
          <div class="panel-heading"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> <strong>Informações do Sistema</strong></div>
          <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [ 
                        'attribute' => 'id',
                        'label' => 'ID (Número da visita)',
                        'format' => 'raw',
                        'value' => $model->id,
                    ],  
                    [ 
                        'attribute' => 'created',
                        'format' => 'raw',
                        'value' => Yii::$app->formatter->asDate($model->created, 'long'),
                        //'value' => date("d/m/Y",  strtotime($model->created))
                    ],           
                    [ 
                        'attribute' => 'updated',
                        'format' => 'raw',
                        'value' => Yii::$app->formatter->asDate($model->updated, 'long'),
                        //'value' => date("d/m/Y",  strtotime($model->updated))
                    ],  
                    [ 
                        'attribute' => 'ip',
                        'label' => 'IP (Terminal de origem)',
                        'format' => 'raw',
                        'value' => $model->ip,
                    ],
                ],
            ]) ?>
          </div>
        </div>
    </div>  

<script>
function myFunction() {
    window.print();
}
</script>
</div>
