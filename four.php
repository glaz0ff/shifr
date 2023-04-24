
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
error_reporting(0);
if(isset($_POST['sub'])){

    define("BLOCK_SIZE", '32');
    define("KEY_SIZE", '64');
    $cipher = "";
    $file = "";

    $bytes = openssl_random_pseudo_bytes(KEY_SIZE/8);
    $key = bin2hex($bytes);

    $inputFile = $_POST['fileDir'];
    $inputFile = "test.txt";
    $input = fopen($inputFile, "rb");

    $keyH = substr($key, 0, 4);
    $keyL = substr($key, 4, 4);

    //Генерация вектора инициализации 32 бита
    $iv = openssl_random_pseudo_bytes(4);
    $cipher = $iv." ";

    while ($block = fread($input, 4)) {
        $file = $file . $block;
        // Добавление бит к блоку если < 32 бит
        $padLength = 4 - strlen($block);
        $block .= str_repeat(chr($padLength), $padLength);

        $blockH = pack("N", unpack("N", $block)[1] ^ unpack("N", $keyH)[1]);
        $blockL = pack("N", unpack("N", $block)[1] ^ unpack("N", $keyL)[1]);

        $ciphertext = $blockH . $blockL;

        $ciphertext = pack("N", unpack("N", $ciphertext)[1] ^ unpack("N", $iv)[1]);

        $cipher = $cipher . $ciphertext;
        $iv = $ciphertext;
    }

    fclose($input);
}
?>


<div class="main_menu">
    <h2>Лабораторная работа 4</h2>
    <form method="post">
        <input type="text" name="fileDir" style="width: 185px" placeholder="file.txt">
        <div style="height: 10px"></div>
        <button type="submit" name="sub" style="height: 20px; width: 185px">Шифровать</button>

    </form>
    <div style="justify-content: left">
        <h2>Ключ: <?=$key?></h2>

        <h2>Результат: </h2>
        <h3>Текст: <?=$file?></h3>
        <h3>Зашифрованный текст: <?=$cipher?></h3>
    </div>
</div>