
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

    $text = $_POST['text-input'];

    // convert the text to binary code sequence
    $binary = '';
    for ($i = 0; $i < strlen($text); $i++) {
        $binary .= str_pad(decbin(ord($text[$i])), 8, '0', STR_PAD_LEFT);
    }

    // CRC12 method implementation
    $generator = 0x80F; // generator polynomial
    $crc = 0xFFF; // initial value for CRC
    for ($i = 0; $i < strlen($binary); $i++) {
        $crc ^= ord($binary[$i]) << 4;
        for ($j = 0; $j < 8; $j++) {
            if ($crc & 0x800) {
                $crc = ($crc << 1) ^ $generator;
                $crc &= 0xFFF; // ensure 12-bit CRC
            } else {
                $crc <<= 1;
                $crc &= 0xFFF; // ensure 12-bit CRC
            }
        }
    }

    // introduce errors in the binary code sequence (for testing purposes)
    $binary_with_errors = $binary;
    $binary_with_errors[2] = ($binary_with_errors[2] == '0') ? '1' : '0';
    $binary_with_errors[10] = ($binary_with_errors[10] == '0') ? '1' : '0';

    // calculate CRC for the received code sequence
    $received_crc = 0xFFF; // initial value for CRC
    for ($i = 0; $i < strlen($binary_with_errors); $i++) {
        $received_crc ^= ord($binary_with_errors[$i]) << 4;
        for ($j = 0; $j < 8; $j++) {
            if ($received_crc & 0x800) {
                $received_crc = ($received_crc << 1) ^ $generator;
                $received_crc &= 0xFFF; // ensure 12-bit CRC
            } else {
                $received_crc <<= 1;
                $received_crc &= 0xFFF; // ensure 12-bit CRC
            }
        }
    }

    $binary_without_errors = $binary;
    $good_crc = 0xFFF;
    for ($i = 0; $i < strlen($binary_without_errors); $i++) {
        $good_crc ^= ord($binary_without_errors[$i]) << 4;
        for ($j = 0; $j < 8; $j++) {
            if ($good_crc & 0x800) {
                $good_crc = ($good_crc << 1) ^ $generator;
                $good_crc &= 0xFFF; // ensure 12-bit CRC
            } else {
                $good_crc <<= 1;
                $good_crc &= 0xFFF; // ensure 12-bit CRC
            }
        }
    }

}
?>
<style>
    textarea{
        width: 500px;
        height: 200px;
    }
</style>

<div class="main_menu">
    <h2>Лабораторная работа 5</h2>
    <form method="POST">
        <input type="text" name="text-input" id="text-input" placeholder="Введите текст">
        <br><br>
        <input type="submit" value="Проверить" name="sub">
    </form>
    <div style="justify-content: center">
        <h3>Результат: </h3>
        <textarea style="height: 70px; ">Исходный текст: <?=$text?></textarea>
        <textarea>Отправленный текст: <?=$binary?></textarea>
        <h3>CRC: <?=$crc?></h3>
        <textarea>Полученный текст: <?=$binary_without_errors?></textarea>
        <h3>CRC: <?=$good_crc?></h3>
        <textarea>Полученный текст (с ошибками): <?=$binary_with_errors?></textarea>
        <h3>CRC: <?=$received_crc?></h3>
    </div>
</div>