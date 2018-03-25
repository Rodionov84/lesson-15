<?php
include("connect.php");

$action = isset($_GET["action"]) ? $_GET["action"] : "";

if( isset($_GET["name"]) )
{
    $nameNewTable = $_GET["name"];
    $newTable = $db->query("CREATE TABLE `$nameNewTable` (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(50),
        author VARCHAR(50),
        id_author INT(11) DEFAULT NULL, PRIMARY KEY (id)
        );");
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>4.4</title>
    </head>

    <body>
    <?php
    if( $action == "field_remove" )
    {
        $table = $_GET["table"];
        $field = $_GET["field"];

        $editStatus = $db->query("ALTER TABLE `" . $table . "` DROP `" . $field . "`");

        echo $editStatus ? "Удаление выполнено успешно. Перенаправление на страницу таблицы.<meta http-equiv=\"refresh\" content=\"3;URL=" . $_SERVER['SCRIPT_NAME']  . "?action=table&table=" . $table . "\" />" : "Ошибка при удалении.";
    }
    else if( $action == "table" )
    {
        $table = $_GET["table"];

        echo "<h2>Таблица: $table</h2>";
        ?>
        <table>
            <thead>
            <tr>
                <th>Имя</th>
                <th>Тип</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $table_info = $db->query("DESCRIBE " . $table);

            if( $table_info->rowCount() )
            {
                foreach ( $table_info as $field )
                {
                    //print_r($field);
                    printf("<tr><td>%s</td><td>%s</td><td><a href='%s?action=field&table=%s&field=%s'>Изменить</a> <a href='%s?action=field_remove&table=%s&field=%s'>Удалить</a></td></tr>",
                        $field["Field"],
                        $field["Type"],
                        $_SERVER['SCRIPT_NAME'],
                        $table,
                        $field["Field"],
                        $_SERVER['SCRIPT_NAME'],
                        $table,
                        $field["Field"]
                    );
                }
            }
            ?>
            </tbody>
        </table>
        <?php
    }
    else if( $action == "field" )
    {
        $table = $_GET["table"];
        $field = $_GET["field"];


        $field_info = NULL;

        $table_info = $db->query("DESCRIBE " . $table);

        if( $table_info && $table_info->rowCount() )
        {
            foreach ( $table_info as $field_info_ )
            {
                if( $field == $field_info_["Field"] )
                {
                    $field_info = $field_info_;
                    break;
                }
            }
        }

        if( $field_info === NULL )
        {
            echo "Такого поля не существует!";
        }
        else
        {
            $editStatus = false;
            if( isset( $_POST["field"] ) )
            {
                $new_field = $_POST["field"];
                $type = $_POST["type"];
                $size = $_POST["size"];

                $query = "ALTER TABLE `" . $table . "` CHANGE `" . $field . "` `" . $new_field . "` " . $type;
                if( $type == "INT" || $type == "VARCHAR" )
                {
                    $query .= "(" . intval($size) . ")";
                }
                if( $type == "text" )
                {
                    $query .= " SET utf8 COLLATE utf8_general_ci";
                }
                $query .= " NOT NULL";

                $editStatus = $db->query($query);

                //print_r($db->errorInfo());
                //echo $query . "<br>";

                echo $editStatus ? "Редактирование выполнено успешно. Перенаправление на страницу таблицы.<meta http-equiv=\"refresh\" content=\"3;URL=" . $_SERVER['SCRIPT_NAME']  . "?action=table&table=" . $table . "\" />" : "Ошибка при редактировании.";
            }

            echo "<h2>Таблица: $table<br>Поле: $field</h2>";

            if( !$editStatus ) {
                //print_r($field_info);

                $matches = null;
                $returnValue = preg_match('/^(INT|VARCHAR|TEXT|DATETIME|tinyint|tinytext){1}(\\((\\d{1,3})\\))?$/i', $field_info["Type"], $matches);
                //print_r($matches);
                ?>
                <form method="post">
                    <label for="field">Имя</label>
                    <input type="text" name="field" value="<?php echo $field; ?>"><br>
                    <label for="type">Тип</label>
                    <select name="type">
                        <option <?php echo ($matches[1] == "int" || $matches[1] == "tinyint") ? "selected" : ""; ?>
                                title="Целое число">
                            INT
                        </option>
                        <option <?php echo ($matches[1] == "varchar") ? "selected" : ""; ?>
                                title="Строка переменной длины (0-65,535)">
                            VARCHAR
                        </option>
                        <option <?php echo ($matches[1] == "text" || $matches[1] == "tinytext") ? "selected" : ""; ?>
                                title="Столбец типа TEXT">
                            TEXT
                        </option>
                        <option <?php echo ($matches[1] == "datetime") ? "selected" : ""; ?>
                                title="Дата-Время">
                            DATETIME
                        </option>
                    </select><br>
                    <label for="size">Размер</label>
                    <input type="text" name="size" value="<?php echo isset($matches[3]) ? $matches[3] : ""; ?>"><br>

                    <input type="submit" value="Изменить"><br>
                </form>
                <?php
            }
        }
    }
    else
    {
    ?>
        <table>
            <thead>
            <tr>
                <th>Название</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $tables = $db->query("SHOW TABLES");

            if( $tables->rowCount() )
                foreach ($tables as $table)
                {
                    printf("<tr><td>%s</td><td><a href='%s?action=table&table=%s'>Изменить</a></td></tr>",
                        $table[0],
                        $_SERVER['SCRIPT_NAME'],
                        $table[0]);
                }
            ?>
            </tbody>
        </table><br>
        <form method="GET">
            <input type="text" name="name" required placeholder="Название таблицы*"><br><br>
            <input type="submit" name="create" value="Создать новую таблицу">
        </form>
    <?php } ?>
    <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">Список таблиц</a>
    </body>
</html>