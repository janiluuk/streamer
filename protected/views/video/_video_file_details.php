<div class="form span-14">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'media-video-form',
	'enableAjaxValidation' => false,
	'focus' => array($model, 'title'),
	'htmlOptions' => array(
		'class' => 'form',
	),
)); ?>
		
	<div class="group span-6 alpha">
		<?php if($model->hasErrors('title')): ?>
                    	<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'title', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('title')): ?>
				<span class="error"><?php echo $model->getError('title'); ?></span>
			</div>
		<?php endif; ?>
		<?php echo $form->textField($model, 'title', array('size' => 30, 'maxlength' => 50, 'class' => 'text')); ?>
	</div>
		
	<div class="span-4">
		<?php if($model->hasErrors('filesize')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'filesize', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('filesize')): ?>
				<span class="error"><?php echo $model->getError('filesize'); ?></span>
			</div>
		<?php endif; ?>
		<?php echo $form->textField($model, 'filesize', array('size' => 30, 'maxlength' => 30, 'class' => 'text')); ?>
	</div>
		
	<div class="group span-6 alpha">
		<?php if($model->hasErrors('filename')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'filename', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('filename')): ?>
				<span class="error"><?php echo $model->getError('filename'); ?></span>
			</div>
		<?php endif; ?>
		<?php echo $form->textField($model, 'filename', array('size' => 30, 'maxlength' => 50, 'class' => 'text')); ?>

	</div>
		<? //echo $model->contentFilePath(); ?>
	<div class="group span-4">
		<?php if($model->hasErrors('filepath')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'filepath', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('filepath')): ?>
				<span class="error"><?php echo $model->getError('filepath'); ?></span>
			</div>
		<?php endif; ?>
		<?php echo $form->textField($model, 'filepath', array('size' => 30, 'maxlength' => 50, 'class' => 'text')); ?>

	</div>
		
		
	
		
		

		
		
	<div class="group span-4 alpha">
		<?php if($model->hasErrors('video_codec')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'video_codec', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('video_codec')): ?>
				<span class="error"><?php echo $model->getError('video_codec'); ?></span>
			</div>
		<?php endif; ?>
 <?php echo $form->textField($model, 'video_codec', array('size' => 8, 'maxlength' => 8, 'style' => 'width:100px;', 'class' => 'text')); ?>
	</div>
		
	<div class="group span-4">
		<?php if($model->hasErrors('audio_codec')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'audio_codec', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('audio_codec')): ?>
				<span class="error"><?php echo $model->getError('audio_codec'); ?></span>
			</div>
		<?php endif; ?>
 <?php echo $form->textField($model, 'audio_codec', array('size' => 8, 'style' => 'width:100px;',  'maxlength' => 8, 'class' => 'text')); ?>
	</div>
		
	<div class="group span-4">
		<?php if($model->hasErrors('video_container')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'video_container', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('video_container')): ?>
				<span class="error"><?php echo $model->getError('video_container'); ?></span>
			</div>
		<?php endif; ?>
 <?php echo $form->textField($model, 'video_container', array('size' => 8, 'maxlength' => 8,'style' => 'width:100px', 'class' => 'text')); ?>
	</div>
	<div class="group span-4 alpha">
		<?php if($model->hasErrors('framerate')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'framerate', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('framerate')): ?>
				<span class="error"><?php echo $model->getError('framerate'); ?></span>
			</div>
		<?php endif; ?>
 <?php echo $form->textField($model, 'framerate', array('class' => 'text','size' => 4, 'style' => 'width:100px','maxlength' => 4)); ?>
	</div>
	<div class="group span-4">
		<?php if($model->hasErrors('audio_samplerate')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'audio_samplerate', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('audio_samplerate')): ?>
				<span class="error"><?php echo $model->getError('audio_samplerate'); ?></span>
			</div>
		<?php endif; ?>
 <?php echo $form->textField($model, 'audio_samplerate', array('class' => 'text','style' =>'width:100px', 'size' => 5, 'maxlength' => 5)); ?>
	</div>

	<div class="group span-4">
		<?php if($model->hasErrors('bitrate')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'bitrate', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('bitrate')): ?>
				<span class="error"><?php echo $model->getError('bitrate'); ?></span>
			</div>
		<?php endif; ?>
 <?php echo $form->textField($model, 'bitrate', array('size' => 5, 'maxlength' => 5, 'style' => 'width:100px','class' => 'text')); ?>
	</div>

	<div class="group span-4 alpha">
		<?php if($model->hasErrors('video_width')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'video_width', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('video_width')): ?>
				<span class="error"><?php echo $model->getError('video_width'); ?></span>
			</div>
		<?php endif; ?>
 <?php echo $form->textField($model, 'video_width', array('class' => 'text','style' => 'width:100px', 'size' => 8, 'maxlength' => 8)); ?>
	</div>
		
	<div class="group span-4">
		<?php if($model->hasErrors('video_height')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'video_height', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('video_height')): ?>
				<span class="error"><?php echo $model->getError('video_height'); ?></span>
			</div>
		<?php endif; ?>
 <?php echo $form->textField($model, 'video_height', array('class' => 'text','size' => 8,'style' => 'width:100px', 'maxlength' => 8)); ?>
	</div>
		
	<div class="group span-4">
		<?php if($model->hasErrors('length')): ?>
			<div class="fieldWithErrors">
		<?php endif; ?>
		<?php echo $form->labelEx($model, 'length', array('class' => 'label')); ?>
		<?php if ($model->hasErrors('length')): ?>
				<span class="error"><?php echo $model->getError('length'); ?></span>
			</div>
		<?php endif; ?>
 <?php echo $form->textField($model, 'length', array('size' => 8,'style' => 'width:100px', 'maxlength' => 8, 'class' => 'text')); ?>
	</div>

	
	<div class="row buttons alpha">
		<?php echo CHtml::submitButton('Tallenna'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
