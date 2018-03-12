<?php

/**
 * This is the model class for table "company_deos".
 *
 * The followings are the available columns in table 'company_deos':
 * @property integer $id
 * @property string $name
 * @property string $email_address
 * @property string $password
 * @property string $code
 * @property string $cnic
 * @property string $designation
 * @property string $mobile_number
 * @property integer $user_type_id
 * @property integer $status
 * @property string $createdOn
 * @property string $expire
 */
class CompanyDeosLive extends MyActiveRecord
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
		return 'company_deos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email_address, password, cnic, designation, mobile_number, user_type_id, status, createdOn, expire', 'required'),
			array('user_type_id, status', 'numerical', 'integerOnly'=>true),
			array('name, email_address, password, code, cnic, designation, mobile_number', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, email_address, password, code, cnic, designation, mobile_number, user_type_id, status, createdOn, expire', 'safe', 'on'=>'search'),
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
			'userType' => array(self::BELONGS_TO, 'UserTypes', 'user_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email_address' => 'Email Address',
			'password' => 'Password',
			'code' => 'Code',
			'cnic' => 'Cnic',
			'designation' => 'Designation',
			'mobile_number' => 'Mobile Number',
			'user_type_id' => 'User Type',
			'status' => 'Status',
			'createdOn' => 'Created On',
			'expire' => 'Expire',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('cnic',$this->cnic,true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('user_type_id',$this->user_type_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('expire',$this->expire,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompanyDeos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
