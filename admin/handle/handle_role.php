<?php
if (isset($_POST["code"]) && isset($_POST["delete"]))
{
    include_once("../class/role.php");
    $roleModel = new role();

    // Thuc hien thay doi trang thai t.khoan
    $code = $_POST["code"];
    if ($_POST["delete"] == "role") $res = $roleModel->deleteRole($code);
    else if ($_POST["delete"] == "function") $res = $roleModel->deleteFunction($code);
    if (trim($res)) {
        echo "success";
    } else echo "fail";
}

if (isset($_POST["create"])) {
    include_once("../class/role.php");
    $roleModel = new role();

    if ($_POST["create"] == "role") {
        // Nhan input
        $newRole = array(
            "Name" => $_POST["name"],
            "Description" => $_POST["description"]
        );
        $res = $roleModel->createRole($newRole);
    }
    else if ($_POST["create"] == "function") {
        // Nhan input
        $newFunction = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"],
            "Description" => $_POST["description"],
            "Icon" => $_POST["icon"],
            "File" => $_POST["file"],
        );
        $res = $roleModel->createFunction($newFunction);
    }
    if (trim($res)) {
        echo "success";
    } else echo "fail";
}

if (isset($_POST["code"]) && isset($_POST["code-func"])) {
    include_once("../class/menu.php");
    $menuModel = new menu();

    $code = $_POST["code"];
    $data = $menuModel->getMenu($code);
    echo json_encode($data);
}

if (isset($_POST["get"])) {
    include_once("../class/role.php");
    $roleModel = new role();

    $data = $roleModel->getFunctions();
    echo json_encode($data);
}

if (isset($_POST["roleSetFunc"])) {
    include_once("../class/role.php");
    $roleModel = new role();

    unset($_POST['roleSetFunc']);
    $res = $roleModel->roleSetFunc($_POST);
    if (trim($res)) {
        echo "success";
    } else echo "fail";

}
?>
