<?php if(isset($links) && is_array($links)):?>
<div style="padding: 20px; clear:both;">
    <?php foreach($links as $link):?>
    <a href="<?=$link[1]?>">
        <button class="btn <?=$link[2] ? 'btn-primary' : '';?>"><?=$link[0]?></button>
    </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>