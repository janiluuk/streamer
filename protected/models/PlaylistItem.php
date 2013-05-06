<?php

Yii::import('application.models._base.BasePlaylistItem');

class PlaylistItem extends BasePlaylistItem
{
    /**
     * @return PlaylistItem
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'PlaylistItem|PlaylistItems', $n);
    }

}