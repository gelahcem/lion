<?php

/**
 * This is the model class for table "Pratiche".
 *
 * The followings are the available columns in table 'Pratiche':
 * @property integer $id
 * @property string $id_pratica
 * @property string $data_creazione
 * @property string $stato_pratica
 * @property string $note
 * @property integer $id_cliente
 */
class Pratiche extends CActiveRecord
{
	public $varFullname;
	public $codiceFiscale;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Pratiche';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pratica, data_creazione, stato_pratica, note, id_cliente', 'required'),
			array('id_cliente', 'numerical', 'integerOnly'=>true),
			array('id_pratica', 'length', 'max'=>32),
			array('stato_pratica', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_pratica, data_creazione, stato_pratica, note, id_cliente, codiceFiscale, varFullname, cliente', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cliente' => array(self::HAS_ONE, 'Cliente', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_pratica' => 'Id Pratica',
			'data_creazione' => 'Data Creazione',
			'stato_pratica' => 'Stato Pratica',
			'note' => 'Note',
			'id_cliente' => 'Id Cliente',
			'codiceFiscale' => 'Cod.Fiscale / P.IVA'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with = array('cliente');
		$criteria->compare('id',$this->id);
		$criteria->compare('id_pratica',$this->id_pratica,true);
		$criteria->compare('data_creazione',$this->data_creazione,true);
		$criteria->compare('stato_pratica',$this->stato_pratica,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('id_cliente',$this->id_cliente);
		$criteria->compare('concat(cliente.nome," ",cliente.conogme)',$this->varFullname,true);
		$criteria->compare('cliente.codice_fiscale', $this->codiceFiscale,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pratiche the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getCompiledFullname()
	{
		if ($this->cliente !== null) {
			return
				$this->cliente->nome . ' ' .
				$this->cliente->conogme;
		} else {
			return NULL;
		}
	}

	public function getCodiceFiscale()
	{
		if ($this->cliente !== null) {
			return
				$this->cliente->codice_fiscale;
		} else {
			return NULL;
		}
	}
}
