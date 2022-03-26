<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
        <li class="nav-item <?=uri_string() == 'TeacherController/MyCalendar' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('TeacherController/MyCalendar') ?>">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">My Calendar </span>
            </a>
          </li>
          <li class="nav-item <?=uri_string() == 'TeacherController/Profile' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('TeacherController/Profile') ?>">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
          <li class="nav-item <?=uri_string() == 'TeacherController/Setting' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('TeacherController/Setting') ?>">
              <i class="menu-icon mdi mdi-cog-outline"></i>
              <span class="menu-title">Settings</span>
            </a>
          </li>
          <li class="nav-item <?=uri_string() == 'TeacherController/Announcement' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('TeacherController/Announcement') ?>">
              <i class="menu-icon mdi mdi-bullhorn"></i>
              <span class="menu-title">Announcement</span>
            </a>
          </li>
          <!-- <li class="nav-item <?=uri_string() == 'TeacherController/ActivityLists' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('TeacherController/ActivityLists') ?>">
            <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Activity Lists</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="Logout()">
              <i class="menu-icon mdi mdi-power"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
