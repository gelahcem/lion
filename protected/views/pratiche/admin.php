<?php
/* @var $this PraticheController */
/* @var $model Pratiche */

$this->breadcrumbs=array(
	'Pratiches'=>array('index'),
	//'Manage',
);

$this->menu=array(
	//array('label'=>'List Pratiche', 'url'=>array('index')),
	//array('label'=>'Create Pratiche', 'url'=>array('create')),
	array('label'=>'Export All DB', 'url'=>array('export'),'visible'=>Yii::app()->user->name=="supervisor"),
	//array('label'=>'File Import (.csv)', 'url'=>array('/importcsv')),
	array('label'=>'File Import (.csv)', 'url'=>array('csvimport'), 'visible'=>Yii::app()->user->name=="supervisor"),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pratiche-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Practices</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:block">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $gridWidget = $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pratiche-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'data_creazione',
		'id_pratica',
		'stato_pratica',
		array(
			'name' => 'varFullname',
			'value' => '($data->CompiledFullname) ? $data->CompiledFullname : ""',
			'header'=> 'Cliente',
			'filter'=> CHtml::activeTextField($model, 'varFullname'),
		),
		array(
			'name' => 'codiceFiscale',
			'value' => '($data->CodiceFiscale) ? $data->CodiceFiscale : ""',
			'header'=> 'Cod.Fiscale / P.IVA',
			'filter'=> CHtml::activeTextField($model, 'codiceFiscale'),
		),
		//'note',
		//'id_cliente',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
));
if(Yii::app()->user->name=="supervisor"){
	$this->renderExportGridButton($gridWidget,'Export Results',array('class'=>'btn btn-info pull-right'));
}

?>
