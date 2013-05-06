<div class="view">

    
                        
                    <?php if (!empty($data->playlist->playlist_name)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('playlist_id')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->playlist->playlist_name) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->video->title)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('video_id')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->video->title) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->order)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('order')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->order) ?>
                            </div>
        </div>

                    <?php endif; ?>
                        </div>