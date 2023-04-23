
<style>
    .main_menu{
        padding-top: 50px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        max-width: 800px;
        margin: auto;
    }
</style>
<?
//error_reporting(0);
if(isset($_POST['sub'])){
    define("BLOCK_SIZE", '32');
    define("KEY_SIZE", '64');

    //$fileDir = $_POST['fileDir'];
    //$file = fopen("$fileDir", 'r');
    $file = "negritos negritos negritos negritos negritos negritos";

    $bytes = openssl_random_pseudo_bytes(KEY_SIZE);
    $key = bin2hex($bytes);

    $b = strlen($file);
    while(gmp_mod($b, BLOCK_SIZE) != 0){
        $file=$file."#";
        $b = strlen($file);
    }

    $binaryFile = bin2hex($file);
    $blockNum = strlen($binaryFile)/BLOCK_SIZE;
    echo " ".$binaryFile." ";
    $lenBlock = strlen($binaryFile)/BLOCK_SIZE;
    for ($i = 0; $i < $blockNum; $i++){
        $bFile[$i] =  substr($binaryFile,$i*$lenBlock, ($i+1)*BLOCK_SIZE);
    }
    var_dump($bFile);



}
?>


<div class="main_menu">
    <h2>Лабораторная работа 4</h2>
    <form method="post">
        <input type="text" name="fileDir" style="width: 185px" placeholder="Введите текст">
        <div style="height: 10px"></div>
        <button type="submit" name="sub" style="height: 20px; width: 185px">Шифровать</button>

    </form>
    <div style="justify-content: left">
        <h2>Ключи: </h2>


        <h2>Результат: </h2>
        <h3>Текст: </h3>
        <h3>Зашифрованный текст: </h3>
    </div>
</div>