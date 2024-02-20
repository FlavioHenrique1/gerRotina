<?php \Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setHeader('Calendário','Exclusivos para membros');?>

<img src="<?php echo DIRIMG.'calendario.jpg' ?>" alt="">


<a href="<?php echo DIRPAGE.'controllers/controllerLogout'; ?>">Sair</a>

<?php \Classes\ClassLayout::setFooter();?>