<?php

use yii\helpers\Html;
use yii\helpers\Url;


?>

<?php if($prices): ?>
    <?php foreach ($prices as $price): ?>
        <p>
            <a href="<?=Url::to(['/warehouse/update', 'id' => $price->warehouse->id]);?>" target="_blank"><?=$price->warehouse->name;?></a>
            <span> - <?=$price->price;?> р.</span>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
