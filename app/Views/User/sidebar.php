<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item <?=uri_string() == 'Home/MyCalendar' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('Home/MyCalendar') ?>">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">My Calendar </span>
            </a>
          </li>

          <li class="nav-item <?=uri_string() == 'Home/Profile' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('Home/Profile') ?>">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>

          <li class="nav-item <?=uri_string() == 'Home/Setting' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('Home/Setting') ?>">
              <i class="menu-icon mdi mdi-cog-outline"></i>
              <span class="menu-title">Settings</span>
            </a>
          </li>

          <li class="nav-item <?=uri_string() == 'Home/StudentManual' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('Home/StudentManual') ?>">
              <i class="mdi mdi-information-outline menu-icon"></i>
              <span class="menu-title">Student Manual </span>
            </a>
          </li>

          <li class="nav-item <?=uri_string() == 'Home/IsuMap' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('Home/IsuMap') ?>">
              <i class="mdi mdi-google-maps menu-icon"></i>
              <span class="menu-title">Isu Map </span>
            </a>
          </li>

          <li class="nav-item <?=uri_string() == 'Home/ProfessorProfile' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('Home/ProfessorProfile') ?>">
              <i class="mdi mdi-account-supervisor-circle-outline menu-icon"></i>
              <span class="menu-title">Professors Profile </span>
            </a>
          </li>

          <li class="nav-item <?=uri_string() == 'Home/Announcement' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('Home/Announcement') ?>">
              <i class="menu-icon mdi mdi-bullhorn"></i>
              <span class="menu-title">Announcement</span>
            </a>
          </li>
          <!-- <li class="nav-item <?=uri_string() == 'Home/AnsweredActivity' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('Home/AnsweredActivity') ?>">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Answered Activity</span>
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
