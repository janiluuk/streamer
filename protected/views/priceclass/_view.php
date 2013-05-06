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
                        </div>