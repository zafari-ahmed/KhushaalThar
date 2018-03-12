<?php

/**
 * This is the model class for table "labour_police".
 *
 * The followings are the available columns in table 'labour_police':
 * @property integer $id
 * @property integer $labour_id
 * @property integer $police_verified
 * @property string $submitted_date
 * @property string $cleared_date
 * @property string $security_date
 * @property string $status
 */
class LabourPolice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'labour_police';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('labour_id, police_verified, status', 'required'),
			array('labour_id, police_verified', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>255),
			array('submitted_date, cleared_date, security_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, labour_id, police_verified, submitted_date, cleared_date, security_date, status', 'safe', 'on'=>'search'),
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
			'police_verified' => 'Police Verified',
			'submitted_date' => 'Submitted Date',
			'cleared_date' => 'Cleared Date',
			'security_date' => 'Security Date',
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
		$criteria->compare('police_verified',$this->police_verified);
		$criteria->compare('submitted_date',$this->submitted_date,true);
		$criteria->compare('cleared_date',$this->cleared_date,true);
		$criteria->compare('security_date',$this->security_date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabourPolice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}