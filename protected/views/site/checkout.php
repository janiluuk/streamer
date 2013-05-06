<?php foreach($xml->payments->payment->banks as $bankX):?>
<?php foreach($bankX as $bank):?>
   <div class='C1'>
      <form action='<?=$bank['url'];?>' method='post'>
      <?php foreach($bank as $key => $value):?>
      <input type='hidden' name='<?=$key;?>' value='<?=htmlspecialchars($value);?>'>
      <?php endforeach;?>
      <span><input type='image' src='<?=$bank['icon'];?>'> </span>
      <div>
      <?=$bank['name'];?>
      </div>
      </form>
      </div>
      <?php endforeach;?>
      <?php endforeach;?>
      

