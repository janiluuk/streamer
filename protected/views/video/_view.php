<div class="view">

    
                        
                    <?php if (!empty($data->title)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('title')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->title) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->filesize)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('filesize')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->filesize) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->filename)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('filename')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->filename) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->filepath)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('filepath')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->filepath) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->created_at)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('created_at')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= Yii::app()->getDateFormatter()->formatDateTime($data->created_at, 'medium', 'medium') ?>
                <br/>
                 <?= date('D, d M y H:i:s', strtotime($data->created_at)) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->updated_at)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('updated_at')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= Yii::app()->getDateFormatter()->formatDateTime($data->updated_at, 'medium', 'medium') ?>
                <br/>
                 <?= date('D, d M y H:i:s', strtotime($data->updated_at)) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->language_id)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('language_id')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->language_id) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->type)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('type')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->type) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->bitrate)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('bitrate')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->bitrate) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->framerate)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('framerate')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->framerate) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->video_container)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('video_container')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->video_container) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->video_codec)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('video_codec')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->video_codec) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->audio_codec)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('audio_codec')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->audio_codec) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->audio_samplerate)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('audio_samplerate')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->audio_samplerate) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->video_width)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('video_width')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->video_width) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->video_height)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('video_height')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->video_height) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->length)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('length')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->length) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->profile)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('profile')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->profile) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->is_primary)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('is_primary')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->is_primary) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->primary)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('primary')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->primary) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('deleted')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->deleted == 1 ? 'True' : 'False') ?>
                            </div>
        </div>

                                
                    <?php if (!empty($data->user->username)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('user_id')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->user->username) ?>
                            </div>
        </div>

                    <?php endif; ?>
                        </div>