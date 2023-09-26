<!-- Left Sidebar -->
<div class="sidebar" id="sidebar" style="display: none;">
        <div class="d-flex justify-content-center">
            <a href="" class="text-decoration-none text-white"><img src="../assets/images/think-wise-white.png"  width="150"></a>
        </div>
        <div class="pt-3"></div>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="background-color: rgba(65, 65, 70, 0.548); border-color: rgb(111, 111, 111)">
        </form>
        <hr>

        <!-- sidebar nav -->
        <ul class="nav flex-column" id="nav_accordion">
            <li class="nav-item" >
                <a class="sidebar-link" href="../dashboard/">
                    <i class="bi bi-speedometer2"></i>&nbsp;&nbsp;&nbsp;Dashboard
                </a>
            </li>
            <li class="nav-item has-submenu soc-1">
                <a class="sidebar-link d-flex justify-content-between" href="#">
                    <div>
                        <i class="bi bi-briefcase"></i>&nbsp;&nbsp;&nbsp;Engagements
                    </div>
                    <div class="right">
                        <i class="bi bi-plus icon-plus"></i>
                        <i class="bi bi-dash icon-dash d-none"></i>
                    </div>
                </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="../engagements/">All Engagements</a></li>
                    <li><a class="nav-link" href="../add_engagement/">Add Engagement</a></li>
                </ul>
            </li>
            <li class="nav-item has-submenu soc-1">
                <a class="sidebar-link d-flex justify-content-between" href="#">
                    <div>
                        <i class="bi bi-calendar-week"></i>&nbsp;&nbsp;&nbsp;Meetings
                    </div>
                    <div class="right">
                        <i class="bi bi-plus icon-plus"></i>
                        <i class="bi bi-dash icon-dash d-none"></i>
                    </div>
                </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="../meetings/">All Meetings</a></li>
                    <li><a class="nav-link" href="../add_meeting/">Add Meeting</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="sidebar-link" href="../personnel/">
                    <i class="bi bi-people-fill"></i>&nbsp;&nbsp;&nbsp;Personnel
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link" href="../admin-tools/">
                    <i class="bi bi-gear-fill"></i>&nbsp;&nbsp;&nbsp;Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link" href="#" id="logout-link">
                    <i class="bi bi-door"></i>&nbsp;&nbsp;&nbsp;Logout
                </a>
            </li>            
        </ul>
        <!-- end sidebar nav -->

    </div>
    <!-- end left sidebar -->