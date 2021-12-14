<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <?php
                include_once("../class/menu.php");
                $menuModel = new menu();

                $data = $menuModel->getMenu($_SESSION['user']['Permission']);
                $flag = true;
                foreach ($data as $key=>$val) {
                    $render = "<li class='sidebar-item ";
                    if ($flag) {
                        $render .= "pt-2'>";
                        $flag = false;
                    } else $render .= "'>";
                    $render .= "
                                <a class='sidebar-link waves-effect waves-dark sidebar-link' href='{$val['File']}'
                                       aria-expanded='false'>
                                        <i class='{$val['Icon']}' aria-hidden='true'></i>
                                        <span class='hide-menu'>{$val['Name']}</span>
                                    </a>
                            </li>
                            ";
                    echo $render;
                }
                ?>
                <li class="text-center p-20 upgrade-btn">
                    <a href="../handle/handle_login.php?username=<?php echo $_SESSION['user']['User'] ?>&logout=logout  "
                       class="btn d-grid btn-danger text-white" >
                        Log out</a>
                </li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>