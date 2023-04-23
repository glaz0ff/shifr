
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
//    function str_to_num ($word){
//        $symbol = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', ' ', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
//        for($i = 0; $i < count($word); $i++){
//            for($j = 0; $j < count($symbol); $j++){
//                if($word[$i] == $symbol[$j]){
//                        $word[$i] = $j+10;
//                }
//            }
//        }
//        return $word;
//    }
//    function int_to_bin ($arr){
//        for($i = 0; $i < count($arr); $i++){
//            $arr2[$i] = decbin($arr[$i]);
//        }
//        return $arr2;
//    }
    $arr = str_split($_POST['word']);
//    $word = str_to_num($arr);
//    $arr2 = int_to_bin($word);
//    $text = implode("", $arr2);
//    echo $text;
    for ($i = 0; $i < count($arr); $i++)
    {
        $arr2[$i] = pack("@", $arr[$i]);
    }
    var_dump($arr2);

}
?>


<div class="main_menu">
    <h2>Лабораторная работа 5</h2>
    <form method="post">
        <input type="text" name="word" style="width: 185px" placeholder="Введите текст">
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