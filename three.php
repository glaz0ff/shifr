
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
    function is_prime ($n){ //проверка числа на простоту
        for($x=2; $x <= sqrt($n); $x++) {
            if($n % $x == 0) {
                return false;
            }
        }
        return true;
    }
    function str_to_num ($word){
        $symbol = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', ' ', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        for($i = 0; $i < count($word); $i++){
            for($j = 0; $j < count($symbol); $j++){
                if($word[$i] == $symbol[$j]){
                    if ($j < 10)
                        $word[$i] = "0".$j+1;
                    else
                        $word[$i] = $j+1;
                    break;
                }
            }
        }
//        $word2 = implode("", $word);
//        return intval($word2);
        return $word;
    }
    $word2 = $_POST['word'];
    $arr = str_split($_POST['word']);
    $word = str_to_num($arr);
    $flag = 0;
    while(!$flag) {
        $n = rand(2053, 10000); //разрядность не меньше 12-и (100000000000 в двоичной = 2048 в десятичной)
        if(is_prime($n))
            $flag = 1;
    }
    while(!$flag) {
        $x = rand(1, 100);
        if(is_prime($x))
            $flag = 1;
    }
    while($flag) {
        $q = rand(2053, 10000);
        if(is_prime($q))
            $flag = 0;
    }
    $u = pow($q, $x);
    $A = gmp_mod($u , $n);

    for($i = 0; $i < count($word); $i++){
        $word[$i] = $word[$i] + $A;
    }
}
if(isset($_POST['sub2']))
{
    while($flag) {
    $y = rand(1, 100);
    if(is_prime($y))
        $flag = 0;
    }



}

?>


<div class="main_menu">
    <h2>Лабораторная работа 2</h2>
    <form method="post">
        <input type="text" name="word" style="width: 185px" placeholder="Введите текст">
        <div style="height: 10px"></div>
        <button type="submit" name="sub" style="height: 20px; width: 185px">Шифровать</button>

    </form>
    <div style="justify-content: left">
        <h2>Ключи: </h2>
        <p>n: <?=$n;?></p>
        <p>q: <?=$q;?></p>
        <p>x: <?=$x;?></p>
        <p>y: <?=$y;?></p>
        <p>A: <?=$A;?></p>
        <p>B: <?=$B;?></p>
        <p>Kx: <?=$Kx;?></p>
        <p>Ky: <?=$Ky;?></p>

        <h2>Результат: </h2>
        <h3>Текст: <?=$word2;?></h3>
        <h3>Зашифрованный текст: <?=$cipher;?></h3>
    </div>
</div>