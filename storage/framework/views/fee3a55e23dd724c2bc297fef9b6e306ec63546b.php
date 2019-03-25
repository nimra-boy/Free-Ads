<?php /* /home/armin/Documents/PHP/Piscine_MVC_Free_Ads/vendor/laravel/framework/src/Illuminate/Mail/resources/views/html/subcopy.blade.php */ ?>
<table class="subcopy" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <?php echo e(Illuminate\Mail\Markdown::parse($slot)); ?>

        </td>
    </tr>
</table>
