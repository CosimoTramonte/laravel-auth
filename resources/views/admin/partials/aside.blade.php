
<aside>
    <nav>
        <ul>
            <a href="{{ route('admin.home') }}">
                <li>
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </li>
            </a>
            <a href="{{route('admin.projects.index')}}">
                <li>
                    <i class="fa-solid fa-list"></i>
                    <span>Projects</span>
                </li>
            </a>
            <a href="{{route('admin.projects.create')}}">
                <li>
                    <i class="fa-solid fa-square-plus"></i>
                    <span>New Projects</span>
                </li>
            </a>
        </ul>
    </nav>
</aside>
