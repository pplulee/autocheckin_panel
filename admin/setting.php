<?php
include("header.php");
if (isset($_POST['submit'])) {
    foreach ($_POST['setting_name'] as $key => $value) {
        $value = htmlspecialchars($value);
        mysqli_query($conn, "UPDATE setting SET content='$value' WHERE name='$key'");
    }
    echo "<script>alert('修改成功!');window.location.href='setting.php';</script>";
    exit;
}
?>
<title>网站设置</title>
<div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>设置项ID</th>
                    <th>名称</th>
                    <th>内容</th>
                </tr>
                </thead>
                <form action='' method='post'>
                <?php
                $result = mysqli_query($conn, "SELECT id,name,content FROM setting;");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $content = htmlspecialchars_decode($row['content']);
                        echo "<tr><th>{$row['id']}</th><td>{$row['name']}</td><td><input type='text' autocomplete='off' class='form-control' name='setting_name[{$row['name']}]' value='{$content}'></td></tr>";
                    }
                }
                ?>
                    <input type='submit' class='btn btn-primary' name='submit' value='保存'>
                </form>
            </table>
        </div>
    </div>
</div>

