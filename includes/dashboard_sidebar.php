<aside class="sidebar">
    <div class="sidebar-body">
        <ul>
            <li>
                <a href="index.php" class="sidebar-link <?= ($activePage == 'index') ? 'active':''; ?>">
                    <i class='bx bxs-dashboard'></i> Dashboard
                </a>
            </li>
            <li>
                <a href="consumers.php" class="sidebar-link <?= ($activePage == 'consumers') ? 'active':''; ?>">
                    <i class="fa-solid fa-users"></i> Consumers
                </a>
            </li>
            <li>
                <a href="billings.php" class="sidebar-link <?= ($activePage == 'billings') ? 'active':''; ?>">
                    <i class="fa-solid fa-money-bill-transfer"></i> Billings
                </a>
            </li>
        </ul>
    </div>
</aside>