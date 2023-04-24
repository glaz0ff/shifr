
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
if(isset($_POST['sub'])) {

    $text = file_get_contents("test.txt");

    $freqs = array_fill(0, 256, 0);
    for ($i = 0; $i < strlen($text); $i++) {
        $freqs[ord($text[$i])]++;
    }
    $total = strlen($text);
    for ($i = 0; $i < 256; $i++) {
        $freqs[$i] /= $total;
    }
    $low = 0;
    $high = 0xFFFFFFFF;
    $range = 0xFFFFFFFF;
    $output = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $symbol = ord($text[$i]);
        $symbol_low = $low + (int)($range * array_sum(array_slice($freqs, 0, $symbol)));
        $symbol_high = $low + (int)($range * array_sum(array_slice($freqs, 0, $symbol+1)));
        $low = $symbol_low;
        $high = $symbol_high;
        $range = $high - $low;
        while (($low & 0x80000000) == ($high & 0x80000000)) {
            $bit = (($low >> 31) & 1) ? '1' : '0';
            $output .= $bit;
            $low <<= 1;
            $high <<= 1;
            $high |= 1;
            $low &= 0xFFFFFFFE;
        }
    }
    while ($low != 0) {
        $bit = (($low >> 31) & 1) ? '1' : '0';
        $output .= $bit;
        $low <<= 1;
    }

    $count = 1;
    $prev_bit = $output[0];
    $rle_output = "";
    for ($i = 1; $i < strlen($output); $i++) {
        if ($output[$i] == $prev_bit) {
            $count++;
        } else {
            $rle_output .= $count . $prev_bit;
            $count = 1;
            $prev_bit = $output[$i];
        }
    }
    $rle_output .= $count . $prev_bit;

    file_put_contents("compressed.txt", $rle_output);
    $text1 = file_get_contents("compressed.txt");
}
?>


<div class="main_menu">
    <h2>Лабораторная работа 6</h2>
    <form method="post">
        <input type="text" name="fileDir" style="width: 185px" placeholder="test.txt">
        <div style="height: 10px"></div>
        <button type="submit" name="sub" style="height: 20px; width: 185px">Шифровать</button>

    </form>
    <div style="justify-content: left">
        <h2>Исходный текст: </h2>
        <textaria><?=$text?></textaria>
        <h2>Результат: </h2>
        <textaria><?=$text1?></textaria>
    </div>
</div>