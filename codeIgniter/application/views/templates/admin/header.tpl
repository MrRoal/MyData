<header>
    <nav class="navbar navbar-static-top">
        <div class="navbar">
            <a href="{$data.admin_url}home" class="in-logo innerlogopart"> <img src='{$data.base_image}inner-logo-admin.png' class='headerlogoimgsize' alt="Happy Hour"></img></a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown widget-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>{$data.admindetail.vFirstName} {$data.admindetail.vLastName} <i class="fa fa-caret-down"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="footer">
                            <a href="{$data.admin_url}authentication/logout"><i class="fa fa-power-off"></i>Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>