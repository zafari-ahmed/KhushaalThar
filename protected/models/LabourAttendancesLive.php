<?php

/**
 * This is the model class for table "labour_attendances".
 *
 * The followings are the available columns in table 'labour_attendances':
 * @property integer $id
 * @property integer $labour_id
 * @property integer $requisition_id
 * @property string $date
 * @property integer $month
 */
class LabourAttendances extends MyActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'labour_attendances';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('labour_id, requisition_id, date, month', 'required'),
			array('labour_id, requisition_id, month', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, labour_id, requisition_id, date, month', 'safe', 'on'=>'search'),
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
			'labour_id' => 'Labour',
			'requisition_id' => 'Requisition',
			'date' => 'Date',
			'month' => 'Month',
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
		$criteria->compare('requisition_id',$this->requisition_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('month',$this->month);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabourAttendances the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
