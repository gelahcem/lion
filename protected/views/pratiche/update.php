<?php
/* @var $this PraticheController */
/* @var $model Pratiche */

$this->breadcrumbs=array(
	'Pratiches'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pratiche', 'url'=>array('index')),
	array('label'=>'Create Pratiche', 'url'=>array('create')),
	array('label'=>'View Pratiche', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pratiche', 'url'=>array('admin')),
);
?>

<h1>Update Pratiche <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>