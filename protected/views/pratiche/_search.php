<?php
/* @var $this PraticheController */
/* @var $model Pratiche */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_pratica'); ?>
		<?php echo $form->textField($model,'id_pratica',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codiceFiscale'); ?>
		<?php echo $form->textField($model,'codiceFiscale',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
	<div class="row">
		<p>PRATICHE TROVATE</p>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->