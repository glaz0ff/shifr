
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

    function block_cipher($block, $key) {

      $block_int = unpack("N", $block)[1];
      $key_int = unpack("J", $key)[1];
      $result_int = $block_int ^ $key_int;

      $result = pack("N", $result_int);
      return $result;
    }

    function hash_password($password) {

      $key = random_bytes(8);
      $padded_password = str_pad($password, ceil(strlen($password) / 4) * 4, "\0");
      $blocks = str_split($padded_password, 4);

      $hashed_blocks = array_map(function($block) use ($key) {
        return block_cipher($block, $key);
      }, $blocks);

      $hashed_password = implode("", $hashed_blocks);
      return $hashed_password;
    }

    $password = $_POST['pass'];
    $hashed_password = bin2hex(hash_password($password));
    //echo $hashed_password;
}
?>


<div class="main_menu">
    <h2>Лабораторная работа 7</h2>
    <form method="post">
        <input type="text" name="pass" style="width: 185px" placeholder="Пароль 11 символов">
        <div style="height: 10px"></div>
        <button type="submit" name="sub" style="height: 20px; width: 185px">Шифровать</button>

    </form>
    <div style="justify-content: left">
        <h2>Результат: </h2>
        <h3>Пароль: <?=$password?></h3>
        <h3>Захешированный пароль: <?=$hashed_password?></h3>

    </div>
</div>