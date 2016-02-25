<?php

namespace app\modules\blog\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $text_preview
 * @property string $img
 */
class Posts extends \yii\db\ActiveRecord
{
    public $image;
    public $filename;
    public $string;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'text_preview'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['text'], 'string', 'max' => 250],
            [['text_preview'], 'string', 'max' => 100],
            [['title'], 'unique'],
            [['text'], 'unique'],
            [['text_preview'], 'unique'],
            [['img'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'text_preview' => 'Text Preview',
            'img' => 'Img',
        ];
    }

    public function beforesave($insert)
    {
        if ($this->isNewRecord) {
            //generate = upload
            $this->string = substr(uniqid('img'), 0, 12);
            $this->image = UploadedFile::getInstance($this, 'img');
            $this->filename = 'static/images/' . $this->string . '.' . $this->image->extension;
            $this->image->saveAs($this->filename);
            $this->img = '/' . $this->filename;
        } else {
            $this->imgage = UploadedFile::getInstance($this, 'images');
            if ($this->image) {
                $this->imageg->saveAs(substr($this->img, 1));
            }
        }

        return parent::beforeSave($insert);
    }
}
