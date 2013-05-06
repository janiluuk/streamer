<div class="view">

    
                        
                    <?php if (!empty($data->playlist_name)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('playlist_name')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->playlist_name) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('active')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->active == 1 ? 'True' : 'False') ?>
                            </div>
        </div>

                                
                    <?php if (!empty($data->from)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('from')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= Yii::app()->getDateFormatter()->formatDateTime($data->from, 'medium', 'medium') ?>
                <br/>
                 <?= date('D, d M y H:i:s', strtotime($data->from)) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->to)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('to')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= Yii::app()->getDateFormatter()->formatDateTime($data->to, 'medium', 'medium') ?>
                <br/>
                 <?= date('D, d M y H:i:s', strtotime($data->to)) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->channel_id)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('channel_id')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->channel_id) ?>
                            </div>
        </div>

                    <?php endif; ?>
                        </div>