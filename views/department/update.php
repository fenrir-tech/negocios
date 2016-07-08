<?php

use yii\helpers\Html;

$this->title = 'Alteração do Departamento: #' . $model->id;
?>
<div class="department-update">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('//site/_menuadmin'); ?>
    </div>

    <div class="col-sm-10">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;">
        <?= Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Lista de Departamentos', ['index'], ['class' => 'btn btn-success']) ?>
      </span></div>
    </div>
    <hr/>

    <div class="panel panel-default">
      <div class="panel-body">     

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

        </div>
    </div>

    </div>
    </div>    

</div>