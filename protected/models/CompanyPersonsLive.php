<?php

/**
 * This is the model class for table "company_persons".
 *
 * The followings are the available columns in table 'company_persons':
 * @property integer $id
 * @property integer $company_id
 * @property string $code
 * @property string $name
 * @property string $email_address
 * @property string $password
 * @property string $cnic
 * @property string $mobile_number
 * @property string $designation
 * @property integer $status
 * @property string $createdOn
 */
class CompanyPersonsLive extends MyActiveRecord
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
		return 'company_persons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, code, name, email_address, password, cnic, mobile_number, designation, status, createdOn', 'required'),
			array('company_id, status', 'numerical', 'integerOnly'=>true),
			array('email_address','unique', 'on'=>'insert'),
			array('cnic','unique'),
			array('code, name, email_address, password, cnic, mobile_number, designation', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id, code, name, email_address, password, cnic, mobile_number, designation, status, createdOn', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'ClientCompanies', 'company_id'),
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
			'code' => 'Code',
			'name' => 'Name',
			'email_address' => 'Email Address',
			'password' => 'Password',
			'cnic' => 'Cnic',
			'mobile_number' => 'Mobile Number',
			'designation' => 'Designation',
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
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('cnic',$this->cnic,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('designation',$this->designation,true);
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
	 * @return CompanyPersons the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
