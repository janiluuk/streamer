<div class="view">

    
                        
                    <?php if (!empty($data->name)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('name')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->name) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
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
                                    
                    <?php if (!empty($data->identifier)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('identifier')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->identifier) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->active)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('active')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->active) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->background_color)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('background_color')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->background_color) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->background_style)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('background_style')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->background_style) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->backgroundImage->title)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('background_image')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->backgroundImage->title) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->channel_style)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('channel_style')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->channel_style) ?>
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
                        </div>