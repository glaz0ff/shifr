
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

    function encrypt($text, $gamma) {
        $blocks = str_split($text, 8);

        $ciphertext = "";
        foreach ($blocks as $block) {
            $ciphertext .= pack("P", unpack("P", $block)[1] ^ $gamma);
        }
        return $ciphertext;
    }

    $text = $_POST['text'];
    $ciphertext = encrypt($text, 0xdeadbeef);

    $cipher = bin2hex($ciphertext);
}
?>


<div class="main_menu">
    <h2>Лабораторная работа 8</h2>
    <form method="post">
        <input type="text" name="text" style="width: 185px" placeholder="Введите текст">
        <div style="height: 10px"></div>
        <button type="submit" name="sub" style="height: 20px; width: 185px">Шифровать</button>

    </form>
    <div style="justify-content: left">
        <h2>Результат: </h2>
        <h3>Текст: <?=$text?></h3>
        <h3>Зашифрованный текст: <?=$cipher?></h3>

    </div>
</div>