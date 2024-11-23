<ul class="sidenav-inner py-1">
    <!-- Dashboards -->
    <li class="sidenav-item {{Request::is('/') ? 'active' : ''}}">
        <a href="/" class="sidenav-link">
            <i class="sidenav-icon feather icon-home"></i>
            <div>Dashboards</div>
        </a>
    </li>

    <li class="sidenav-item {{Request::is('wilayah*') ? 'active' : ''}}">
        <a href="/wilayah" class="sidenav-link">
            <i class="sidenav-icon feather icon-map"></i>
            <div>Data Wilayah</div>
        </a>
    </li>

    <li class="sidenav-item  {{Request::is('unit*') ? 'active' : ''}}">
        <a href="/unit" class="sidenav-link">
            <i class="sidenav-icon feather icon-shield"></i>
            <div>Data Unit Pemadam</div>
        </a>
    </li>

    <li class="sidenav-item  {{Request::is('petugas*') ? 'active' : ''}}">
        <a href="/petugas" class="sidenav-link">
            <i class="sidenav-icon feather icon-users"></i>
            <div>Data Petugas</div>
        </a>
    </li>
    <li class="sidenav-item  {{Request::is('user*') ? 'active' : ''}}">
        <a href="/user" class="sidenav-link">
            <i class="sidenav-icon feather icon-user"></i>
            <div>Data User</div>
        </a>
    </li>
    <li class="sidenav-item  {{Request::is('laporan*') ? 'active' : ''}}">
        <a href="/laporan" class="sidenav-link">
            <i class="sidenav-icon feather icon-file-text"></i>
            <div>Data Laporan</div>
        </a>
    </li>
</ul>
