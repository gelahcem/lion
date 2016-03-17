<?php
/* @var $this PraticheController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pratiches',
);

$this->menu=array(
	array('label'=>'Create Pratiche', 'url'=>array('create')),
	array('label'=>'Manage Pratiche', 'url'=>array('admin')),
);
?>

<h1>Pratiches</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
