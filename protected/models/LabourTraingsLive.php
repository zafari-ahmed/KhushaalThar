<?php

/**
 * This is the model class for table "labour_traings".
 *
 * The followings are the available columns in table 'labour_traings':
 * @property integer $id
 * @property integer $labour_id
 * @property integer $traings
 * @property integer $training_id
 * @property string $institute
 * @property string $trade
 * @property string $score
 * @property string $result
 * @property string $batch_number
 * @property integer $status
 */
class LabourTraingsLive extends MyActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function getDbConnection()
    {
        return self::getRailDbConnection();
    }
	public function tableName()
	{
		return 'labour_traings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('labour_id, traings, institute, trade, score, result, batch_number, status', 'required'),
			array('labour_id, traings, training_id, status', 'numerical', 'integerOnly'=>true),
			array('institute, trade, score, result, batch_number', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, labour_id, traings, training_id, institute, trade, score, result, batch_number, status', 'safe', 'on'=>'search'),
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
			'training' => array(self::BELONGS_TO, 'Trainings', 'training_id'),
			'labor' => array(self::BELONGS_TO, 'Labours', 'labour_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'labour_id' => 'Labour',
			'traings' => 'Traings',
			'training_id' => 'Training',
			'institute' => 'Institute',
			'trade' => 'Trade',
			'score' => 'Score',
			'result' => 'Result',
			'batch_number' => 'Batch Number',
			'status' => 'Status',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('labour_id',$this->labour_id);
		$criteria->compare('traings',$this->traings);
		$criteria->compare('training_id',$this->training_id);
		$criteria->compare('institute',$this->institute,true);
		$criteria->compare('trade',$this->trade,true);
		$criteria->compare('score',$this->score,true);
		$criteria->compare('result',$this->result,true);
		$criteria->compare('batch_number',$this->batch_number,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabourTraings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
