<?php
/* @var $this PraticheController */
/* @var $model Pratiche */

$this->breadcrumbs=array(
	'Pratiches'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Pratiche', 'url'=>array('index')),
	//array('label'=>'Create Pratiche', 'url'=>array('create')),
	//array('label'=>'Update Pratiche', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Pratiche', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pratiche', 'url'=>array('admin')),
);
?>

<h1>View Pratiche #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_pratica',
		'data_creazione',
		'stato_pratica',
		'note',
		'cliente.nome',
		'cliente.conogme',
	),
)); ?>
