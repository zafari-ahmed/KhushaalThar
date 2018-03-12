<?php

/**
 * This is the model class for table "trainings".
 *
 * The followings are the available columns in table 'trainings':
 * @property integer $id
 * @property string $training_type
 * @property string $institute_name
 * @property string $batch_no
 * @property string $start_date
 * @property string $end_date
 * @property string $createdOn
 * @property integer $status
 */
class Trainings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'trainings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('training_type, institute_name, batch_no, start_date, end_date, createdOn, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('training_type, institute_name, batch_no', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, training_type, institute_name, batch_no, start_date, end_date, createdOn, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'training_type' => 'Training Type',
			'institute_name' => 'Institute Name',
			'batch_no' => 'Batch No',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'createdOn' => 'Created On',
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
		$criteria->compare('training_type',$this->training_type,true);
		$criteria->compare('institute_name',$this->institute_name,true);
		$criteria->compare('batch_no',$this->batch_no,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Trainings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
