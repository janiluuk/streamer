<?php

/**
 * This is the model base class for the table "media_playlist".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Playlist".
 *
 * Columns in table "media_playlist" available as properties of the model,
 * followed by relations of table "media_playlist" available as properties of the model.
 *
 * @property integer $id
 * @property string $playlist_name
 * @property integer $active
 * @property string $from
 * @property string $to
 * @property integer $channel_id
 *
 * @property MediaPlaylistItem[] $mediaPlaylistItems
 */
abstract class BasePlaylist extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'media_playlist';
    }

    public static function representingColumn() {
        return 'playlist_name';
    }

    public function rules() {
        return array(
            array('playlist_name', 'required'),
            array('channel_id', 'numerical', 'integerOnly'=>true),
            array('playlist_name', 'length', 'max'=>255),
            array('from, to, user_id', 'safe'),
            array('from, to', 'default', 'setOnEmpty' => true, 'value' => null),
            array('active', 'default', 'setOnEmpty' => true, 'value' => 1),
            array('id, playlist_name, active, from, to, channel_id', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
		     'Items' => array(self::HAS_MANY, 'PlaylistItem', 'playlist_id', 'order'=>'Items.order'),
	    'Channel' => array(self::BELONGS_TO, 'Channel', 'channel_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'Tunniste'),
                'playlist_name' => Yii::t('app', 'Soittolistan Nimi'),
                'active' => Yii::t('app', 'Aktiivinen'),
                'from' => Yii::t('app', 'Voimassa alkaen'),
                'to' => Yii::t('app', 'Voimassa asti'),
                'channel_id' => Yii::t('app', 'Kanava'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

	$user = Yii::app()->user->data()->id;
      
        $criteria->compare('id', $this->id);
        $criteria->compare('playlist_name', $this->playlist_name, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('from', $this->from, true);
        $criteria->compare('user_id', $user, true);
        $criteria->compare('to', $this->to, true);
        $criteria->compare('channel_id', $this->channel_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}