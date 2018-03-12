<?php

/**
 * This is the model class for table "labour_driving_licenses".
 *
 * The followings are the available columns in table 'labour_driving_licenses':
 * @property integer $id
 * @property integer $labour_id
 * @property string $vehicle_type
 * @property integer $driving_license
 * @property string $driving_license_number
 * @property string $issue_date
 * @property string $valid_upto
 * @property string $license_category
 * @property integer $driving_license_expiry
 */
class LabourDrivingLicensesLive extends MyActiveRecord
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
		return 'labour_driving_licenses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('labour_id, vehicle_type, driving_license, driving_license_number, issue_date, valid_upto, license_category, driving_license_expiry', 'required'),
			array('labour_id, driving_license, driving_license_expiry', 'numerical', 'integerOnly'=>true),
			array('vehicle_type, driving_license_number, license_category', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, labour_id, vehicle_type, driving_license, driving_license_number, issue_date, valid_upto, license_category, driving_license_expiry', 'safe', 'on'=>'search'),
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
			'vehicle_type' => 'Vehicle Type',
			'driving_license' => 'Driving License',
			'driving_license_number' => 'Driving License Number',
			'issue_date' => 'Issue Date',
			'valid_upto' => 'Valid Upto',
			'license_category' => 'License Category',
			'driving_license_expiry' => 'Driving License Expiry',
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
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('driving_license',$this->driving_license);
		$criteria->compare('driving_license_number',$this->driving_license_number,true);
		$criteria->compare('issue_date',$this->issue_date,true);
		$criteria->compare('valid_upto',$this->valid_upto,true);
		$criteria->compare('license_category',$this->license_category,true);
		$criteria->compare('driving_license_expiry',$this->driving_license_expiry);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabourDrivingLicenses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
