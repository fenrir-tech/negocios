<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Department;

?>

<div class="useradmin-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">Informações do Usuário</div>
          <div class="panel-body">
            <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->radioList([
                '1' => 'Sim', 
                '0' => 'Não',
                ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>            

            <hr/>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'celphone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'birthdate')->textInput() ?>

            <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("fullname ASC")->all(), 'id', 'fullname'),['prompt'=>'--'])  ?> 

            <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->where(['is_active' => 1])->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'--'])  ?> 

          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">Permissões de Acesso</div>
          <div class="panel-body">

            <?= $form->field($model, 'can_admin')->radioList([
                '1' => 'Sim', 
                '0' => 'Não',
                ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>

            <?= $form->field($model, 'can_visits')->radioList([
                '1' => 'Sim', 
                '0' => 'Não',
                ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>

            <?= $form->field($model, 'can_productivity')->radioList([
                '1' => 'Sim', 
                '0' => 'Não',
                ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>

            <?= $form->field($model, 'can_requestresources')->radioList([
                '1' => 'Sim', 
                '0' => 'Não',
                ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>

            <?= $form->field($model, 'can_managervisits')->radioList([
                '1' => 'Sim', 
                '0' => 'Não',
                ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>

            <?= $form->field($model, 'can_managerproductivity')->radioList([
                '1' => 'Sim', 
                '0' => 'Não',
                ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>

            <?= $form->field($model, 'can_managerrequestresources')->radioList([
                '1' => 'Sim', 
                '0' => 'Não',
                ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>

          </div>
        </div>
      </div>

    </div>      

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
