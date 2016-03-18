<?php

/**
 * This is the model class for table "Cliente".
 *
 * The followings are the available columns in table 'Cliente':
 * @property integer $id
 * @property string $nome
 * @property string $conogme
 * @property string $codice_fiscale
 * @property string $note
 */
class Cliente extends CActiveRecord
{
	public $dataCreazione;
	public $idPratica;
	public $statoPratica;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, nome, conogme, codice_fiscale, note', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('nome, conogme', 'length', 'max'=>32),
			array('codice_fiscale', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nome, conogme, codice_fiscale, note,dataCreazione,idPratica,statoPratica,pratiche', 'safe', 'on'=>'search'),
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
			'pratiche' => array(self::HAS_MANY, 'Pratiche', 'id_cliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
			'conogme' => 'Cognome',
			'codice_fiscale' => 'Codice Fiscale',
			'note' => 'Note',
			'dataCreazione' => 'Data Creazione',
			'idPratica' => 'Id Pratica',
			'statoPratica' => 'Stato Pratica',
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

		$criteria->with = array('pratiche');

		$criteria->compare('id',$this->id);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('conogme',$this->conogme,true);
		$criteria->compare('codice_fiscale',$this->codice_fiscale,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('pratiche.data_creazione', $this->dataCreazione,true);
		$criteria->compare('pratiche.id_pratica', $this->idPratica,true);
		$criteria->compare('pratiche.stato_pratica', $this->statoPratica,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cliente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getDataCreazione()
	{
		if ($this->pratiche !== null) {
			return
				$this->pratiche->data_creazione;
		} else {
			return NULL;
		}
	}

	public function getIdPratica()
	{
		if ($this->pratiche !== null) {
			return
				$this->pratiche->id_pratica;
		} else {
			return NULL;
		}
	}

	public function getStatoPratica()
	{
		if ($this->pratiche !== null) {
			return
				$this->pratiche->stato_pratica;
		} else {
			return NULL;
		}
	}
}
