<li class="nav-item {{ Nav::isRoute('admin.roles') }}">
    <a class="nav-link" href="{{ route('admin.roles') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Roles</span>
    </a>
</li>
<li class="nav-item {{ Nav::isRoute('member.index') }}">
    <a class="nav-link" href="{{ route('member.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Users</span>
    </a>
</li>
<li class="nav-item {{ Nav::isRoute('admin.assets') }}">
    <a class="nav-link" href="{{ route('admin.assets') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Assets</span>
    </a>
</li>
<li class="nav-item {{ Nav::isRoute('admin.status_kamar') }}">
    <a class="nav-link" href="{{ route('admin.status_kamar') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Status Kamar</span>
    </a>
</li>
<li class="nav-item {{ Nav::isRoute('admin.kamar') }}">
    <a class="nav-link" href="{{ route('admin.kamar') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Kamar</span>
    </a>
</li>
<li class="nav-item {{ Nav::isRoute('admin.asset-kamar') }}">
    <a class="nav-link" href="{{ route('admin.asset-kamar') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Asset Kamar</span>
    </a>
</li>
<li class="nav-item {{ Nav::isRoute('admin.keluhan') }}">
    <a class="nav-link" href="{{ route('admin.keluhan') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Keluhan</span>
    </a>
</li>
<li class="nav-item {{ Nav::isRoute('admin.perbaikan') }}">
    <a class="nav-link" href="{{ route('admin.perbaikan') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Perbaikan</span>
    </a>
</li>
