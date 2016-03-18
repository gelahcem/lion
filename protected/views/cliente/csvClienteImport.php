<?php if(Yii::app()->user->hasFlash('csvClienteImport')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('csvClienteImport'); ?>
    </div>
<?php else: ?>
    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'csvClienteImport',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>
        <fieldset>
            <legend>Import CLIENTI:</legend>

        Fields with <span class="required">*</span> are required.


        <?php echo $form->errorSummary($model, 'There are some errors:'); ?>
        <div class="row">
            <?php echo $form->labelEx($model,'csvFile'); ?>
            <?php echo $form->fileField($model,'csvFile'); ?>
            <?php echo $form->error($model,'csvFile'); ?>
        </div>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Upload File', array('class'=>'btn btn-default')); ?>
        </div>
        <?php $this->endWidget(); ?>
        </fieldset>
    </div>
<?php endif; ?>