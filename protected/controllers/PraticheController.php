<?php

class PraticheController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow supervisor user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('supervisor'),
			),
			array('allow', // allow admin user to perform 'admin'
				'actions'=>array('admin'),
				'users'=>array('admin', 'demo', 'supervisor'),
			),
			array('allow', // allow supervisor user to perform 'csvImport' and 'delete' actions
				'actions'=>array('csvImport','delete','export'),
				'users'=>array('supervisor'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pratiche;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pratiche']))
		{
			$model->attributes=$_POST['Pratiche'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pratiche']))
		{
			$model->attributes=$_POST['Pratiche'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pratiche');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pratiche('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pratiche']))
			$model->attributes=$_GET['Pratiche'];

		if ($this->isExportRequest()) { //<==== [[ADD THIS BLOCK BEFORE RENDER]]
			//set_time_limit(0); //Uncomment to export lage datasets
			//Add to the csv a single line of text
			$this->exportCSV(array('PRATICHE WITH FILTER:'), null, false);
			//Add to the csv a single model data with 3 empty rows after the data
			$this->exportCSV($model, array_keys($model->attributeLabels()), false, 3);
			//Add to the csv a lot of models from a CDataProvider
			$this->exportCSV($model->search(), array('data_creazione', 'id_pratica', 'stato_pratica', 'cliente.nome', 'cliente.conogme'));
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pratiche the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pratiche::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pratiche $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pratiche-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionCsvImport()
	{
        Yii::app()->db->createCommand('set foreign_key_checks=0')->execute();
        Yii::app()->db->createCommand('TRUNCATE Pratiche')->execute();
        Yii::app()->db->createCommand('set foreign_key_checks=1')->execute();

		//var_dump($_POST);
		$model=new CsvUpload;

		if(isset($_POST['CsvUpload']))
		{
			// получаем данные из формы
			$model->csvFile=CUploadedFile::getInstance($model,'csvFile');
			if($model->validate()){
				// данные файла
				$sourcePath = pathinfo($model->csvFile->getName());
				// новое имя для файла
				$csvFile = '_pratica_'.time().'.'. $sourcePath['extension'];
				//Переменной $file присвоить путь, куда сохранится файл
				$file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['csvPath'] .$csvFile;
				//Сохраняем файл;
				$model->csvFile->saveAs($file);
				// открываем файл считываем csv
				if (($handle = fopen($file, "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						$modelMyModel =new Pratiche();

						$modelMyModel->id = $data[0];
						$modelMyModel->id_pratica = $data[1];
						$modelMyModel->data_creazione = $data[2];
						$modelMyModel->stato_pratica = $data[3];
						$modelMyModel->note = $data[4];
						$modelMyModel->id_cliente = $data[5];

						$modelMyModel->save();
					}
					fclose($handle);
				}
				// сообщение о завершении загрузки
				Yii::app()->user->setFlash('csvImport','The file is loaded, the data is added and the coffee is served');
			}
		}
		// вывод формы
		$this->render('csvImport',array(
			'model'=>$model,
		));
	}

	public function behaviors() {
		return array(
			'exportableGrid' => array(
				'class' => 'application.components.ExportableGridBehavior',
				'filename' => 'pratiche_risultato.csv',
				'csvDelimiter' => ',', //i.e. Excel friendly csv delimiter
			));
	}

    public function actionExport()
    {
        $fields = array('id', 'data_creazione', 'id_pratica', 'stato_pratica', 'note', 'id_cliente');

        $criteria = new CDbCriteria();

        $criteria->select = $fields;
        $pratiche = Pratiche::model()->findAll($criteria);

        $filename = 'allExport.csv';
        $csv = new ECSVExport($pratiche);
        $content = $csv->toCSV();
        Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
        exit();
    }
}
