<?php
use Cake\Core\Configure;

$file = Configure::read('Theme.folder') . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'footer.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.11
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.empowered.com" target="_blank">Empowered </a>.</strong> All rights
    reserved.
</footer>
<?php } ?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.11
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.empowered.com" target="_blank">Empowered </a>.</strong> All rights
    reserved.
</footer>
