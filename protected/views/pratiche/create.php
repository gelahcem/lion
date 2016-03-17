<?php
/* @var $this PraticheController */
/* @var $model Pratiche */

$this->breadcrumbs=array(
	'Pratiches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pratiche', 'url'=>array('index')),
	array('label'=>'Manage Pratiche', 'url'=>array('admin')),
);
?>

<h1>Create Pratiche</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>