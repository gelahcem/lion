<?php if(Yii::app()->user->hasFlash('csvImport')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('csvImport'); ?>
    </div>
<?php else: ?>
    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'csvImport',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>

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
    </div>
<?php endif; ?>