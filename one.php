
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
    error_reporting(0);
    // str_split разделяет строку на элементы массива

    $word = $_POST['word'];
    $ciph = $_POST['cipher'];

    $arr = str_split($_POST['word']); // слово
    $arr0 = str_split($_POST['cipher']); // шифр
    $size0 = count($arr0); // размер слова

    for ($i = 0; $i < $size0; $i++)
    {
        $arr0[$i] = $arr0[$i] - 1; // так-как массив начинается с 0, уменьшаем все элементы на 1 для удобства
    }
    for ($i = 0; $i < $size0; $i++)
    {
        $arr_cipher[$i] = $arr[$arr0[$i]]; // шифруем массив
    }

    $cipher = implode("", $arr_cipher); // объединяем массив в зашифрованное слово
}
?>


<div class="main_menu">
    <h2>Лабораторная работа 1</h2>
    <form method="post">
        <input type="text" name="word" style="width: 185px" placeholder="Введите слово">
        <div style="height: 10px"></div>
        <input type="text" name="cipher" style="width: 185px" placeholder="Введите шифр">
        <div style="height: 10px"></div>
        <button type="submit" name="sub" style="height: 20px; width: 185px">Шифровать</button>
    </form>
    <div style="justify-content: left">
        <h2>Результат: </h2>
        <h3>Слово: <?=$word;?></h3>
        <h3>Шифр: <?=$ciph;?></h3>
        <h3>Зашифрованное слово: <?=$cipher;?></h3>
    </div>
</div>