<?php

/**
 * This is the model class for table "requisition_notifications".
 *
 * The followings are the available columns in table 'requisition_notifications':
 * @property integer $id
 * @property integer $company_id
 * @property integer $requisition_id
 * @property string $text
 * @property integer $status
 * @property string $link
 * @property string $createdOn
 */
class RequisitionNotifications extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'requisition_notifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text, status, createdOn', 'required'),
			array('company_id, requisition_id, status', 'numerical', 'integerOnly'=>true),
			array('link', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id, requisition_id, text, status, link, createdOn', 'safe', 'on'=>'search'),
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
			'company_id' => 'Company',
			'requisition_id' => 'Requisition',
			'text' => 'Text',
			'status' => 'Status',
			'link' => 'Link',
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
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('requisition_id',$this->requisition_id);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('createdOn',$this->createdOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequisitionNotifications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
