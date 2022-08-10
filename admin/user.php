<?php
include("header.php");
?>
<title>用户管理</title>
<div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>用户ID</th>
                    <th>邮箱</th>
                    <th>操作</th>
                </tr>
                </thead>
                <?php
                $result = mysqli_query($conn, "SELECT id,email FROM users;");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><th>{$row['id']}</th><td>{$row['email']}</td><td><a href='edituser.php?action=edit&id={$row['id']}' class='btn btn-secondary'>编辑</a> <a href='edituser.php?action=delete&id={$row['id']}' class='btn btn-danger'>删除</a></td></tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
