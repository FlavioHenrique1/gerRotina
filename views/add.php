<?php \Classes\ClassLayout::setHeader('Área Restrita','Exclusivos para membros');?>

<?php 
$date=new \DateTime($_GET['date'],new \DateTimeZone('America/Sao_Paulo'));

?>

    <form action="<?= DIRCONT.'controllerAdd'?>" method="post" name="formAdd" id="formAdd">
        Data: <input type="date" name="date" id="date" value="<?= $date->format("Y-m-d") ?>"><br>
        Hora: <input type="time" name="time" id="time" value="<?= $date->format("H:i") ?>"><br>
        Paciente: <input type="text" name="title" id="title"><br>
        Queixa: <input type="text" name="description" id="description"><br>
        <select name="horasAtendimento" id="horasAtendimento">
            <option value="">Selecione</option>
            <option value="1">1h</option>
            <option value="2">2h</option>
            <option value="3">3h</option>
        </select><br>
        <input type="color" name="color" id="color"><br>
        <input type="submit" value="Marcar consulta">
    </form>
<?php \Classes\ClassLayout::setFooter();?>