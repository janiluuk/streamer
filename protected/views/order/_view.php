<div class="view">

    
                        
                    <?php if (!empty($data->email)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('email')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::mailto($data->email) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->code)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('code')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->code) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->valid_from)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('valid_from')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= Yii::app()->getDateFormatter()->formatDateTime($data->valid_from, 'medium', 'medium') ?>
                <br/>
                 <?= date('D, d M y H:i:s', strtotime($data->valid_from)) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->valid_to)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('valid_to')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= Yii::app()->getDateFormatter()->formatDateTime($data->valid_to, 'medium', 'medium') ?>
                <br/>
                 <?= date('D, d M y H:i:s', strtotime($data->valid_to)) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->channel->name)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('channel_id')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->channel->name) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->payment_type)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('payment_type')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->payment_type) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->amount)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('amount')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->amount) ?>
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
                                    
                    <?php if (!empty($data->priceClass->name)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('price_class_id')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->priceClass->name) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->transaction_data)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('transaction_data')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->transaction_data) ?>
                            </div>
        </div>

                    <?php endif; ?>
                                    
                    <?php if (!empty($data->status)): ?>
                    <div class="field">
            <div class="field_name">
                <b><?= CHtml::encode($data->getAttributeLabel('status')) ?>:</b>
            </div>
            <div class="field_value">
                                <?= CHtml::encode($data->status) ?>
                            </div>
        </div>

                    <?php endif; ?>
                        </div>