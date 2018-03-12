<?php

/**
 * This is the model class for table "labor_requisitions_temp".
 *
 * The followings are the available columns in table 'labor_requisitions_temp':
 * @property integer $id
 * @property integer $labour_id
 * @property integer $requisition_id
 * @property string $accepted_date
 * @property string $rejected_date
 * @property string $reason
 * @property integer $status
 * @property string $createdOn
 */
class LaborRequisitionsTemp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'labor_requisitions_temp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('labour_id, requisition_id, reason, status, createdOn', 'required'),
			array('labour_id, requisition_id, status', 'numerical', 'integerOnly'=>true),
			array('accepted_date, rejected_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, labour_id, requisition_id, accepted_date, rejected_date, reason, status, createdOn', 'safe', 'on'=>'search'),
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
			'labour' => array(self::BELONGS_TO, 'Labours', 'labour_id'),
			'requisition' => array(self::BELONGS_TO, 'ClientCompanyRequisitionDetails', 'requisition_id'),
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
			'accepted_date' => 'Accepted Date',
			'rejected_date' => 'Rejected Date',
			'reason' => 'Reason',
			'status' => 'Status',
			'createdOn' => 'Created On',
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
		$criteria->compare('accepted_date',$this->accepted_date,true);
		$criteria->compare('rejected_date',$this->rejected_date,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createdOn',$this->createdOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LaborRequisitionsTemp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
