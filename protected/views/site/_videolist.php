<?php $this->widget('bootstrap.widgets.TbThumbnails', array(
							    'dataProvider'=>$listDataProvider,
							    'template'=>"{items}\n{pager}",
							    'itemView'=>'_thumb',
							    )); ?>


