<?php
/**
 * CsvUpload class.
 */
class CsvUpload extends CFormModel
{
    public $csvFile;
    public function rules()
    {
        return array(
            // filename are required
            array('csvFile', 'required', 'message'=>'The format must be csv',),
            // проверка типа файла
            array('csvFile', 'file',
                'types' => 'csv,', 'message'=>'The format must be csv',
                'maxSize'=>5000, // 2MB
                'tooLarge'=>'csv too large', 'allowEmpty' => true),
        );
    }
    public function attributeLabels()
    {
        return array(
            'csvFile'=>'The format must be csv',
        );
    }
}