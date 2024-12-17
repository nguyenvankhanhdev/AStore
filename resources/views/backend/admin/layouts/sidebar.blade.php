<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=""></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">||</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ url('admin/dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">Ecommerce</li>

            <li
                class="dropdown {{ setActive(['admin.categories.*', 'admin.sub-categories.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i>
                    <span>Quản lí danh mục</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.categories.*']) }}"><a class="nav-link"
                            href="{{ route('admin.categories.index') }}">Danh mục</a></li>
                    <li class="{{ setActive(['admin.sub-categories.*']) }}"><a class="nav-link"
                            href="{{ route('admin.sub-categories.index') }}">Danh mục phụ</a></li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin.product.*',
                    'admin.product-image-gallery.*',
                    'admin.product-variant.*',
                    'admin.product-variant-item.*',
                    'admin.seller-products.*',
                    'admin.seller-pending-products.*',
                    'admin.best-products',
                    'admin.top-products',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
                    <span>Quản lí sản phẩm</span></a>
                <ul class="dropdown-menu">
                    <li
                        class="{{ setActive([
                            'admin.product.*',
                            'admin.product-image-gallery.*',
                            'admin.product-variant.*',
                            'admin.product-variant-item.*',
                            'admin.reviews.*',
                        ]) }}">
                        <a class="nav-link" href="{{ route('admin.product.index') }}">Sản phẩm</a>
                    </li>
                    <li class="{{ setActive(['admin.seller-products.*',
                    'admin.best-products',]) }}"><a class="nav-link"

                            href="{{ route('admin.best-products') }}">Potential Best Products</a></li>
                    <li class="{{ setActive(['admin.seller-pending-products.*','admin.top-products',]) }}"><a class="nav-link"
                            href="{{ route('admin.top-products') }}">Potential Top Products</a></li>

                </ul>
            </li>
            <li
                class="dropdown {{ setActive([
                    'admin.orders',
                    'admin.orders.pending',
                    'admin.orders.delivered',
                    'admin.orders.canceled',
                    'admin.orders.processed',
                    'admin.orders.completed',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cart-plus"></i>
                    <span>Đơn hàng</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.orders']) }}"><a class="nav-link"
                            href="{{ route('admin.orders') }}">Tất cả đơn hàng</a></li>
                    <li class="{{ setActive(['admin.orders.pending']) }}">
                        <a class="nav-link"
                            href="{{ route('admin.orders.pending') }}">Đơn hàng đang chờ</a>
                        </li>
                    <li class="{{ setActive(['admin.orders.processed']) }}"><a class="nav-link"
                            href="{{ route('admin.orders.processed') }}">Đơn Hàng đang xử lý</a></li>
                    <li class="{{ setActive(['admin.orders.delivered']) }}"><a class="nav-link"
                            href="{{ route('admin.orders.delivered') }}">Đơn hàng đang giao</a></li>

                    <li class="{{ setActive(['admin.orders.canceled']) }}"><a class="nav-link"
                            href="{{ route('admin.orders.canceled') }}">Đơn hàng đã hủy</a></li>
                            <li class="{{ setActive(['admin.orders.completed']) }}"><a class="nav-link"
                                href="{{ route('admin.orders.completed') }}">Đơn hàng đã hoàn thành</a></li>

                </ul>
            </li>
            <li
                class="dropdown {{ setActive([
                    'admin.vendor-profile.*',
                    'admin.coupon.*',
                    'admin.shipping-rule.*',
                    'admin.payment-settings.*',
                    'admin.flash-sale.*',
                    'admin.admincoupon.*',

                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Giảm giá</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}">Flash Sale</a></li>
                    <li class="{{ setActive(['admin.coupon.*']) }}"><a class="nav-link"
                            href="{{ route('admin.admincoupon.index') }}">Phiếu giảm giá</a></li>
                    <li class="{{ setActive(['admin.payment-settings.*']) }}"><a class="nav-link"
                            href="{{ route('admin.payment-settings.index') }}">Payment Settings</a></li>

                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.warehouse','admin.warehouse','admin.warehouse.create']) }}">
                <a href="#" class="nav-link has-dropdown {{ setActive(['admin.warehouse','admin.warehouse.create']) }}" data-toggle="dropdown">
                    <i class="fas fa-warehouse"></i>
                    <span>Kho</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.warehouse','admin.warehouse.create']) }}">
                        <a class="nav-link" href="{{ route('admin.warehouse') }}">Nhập kho</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.reports','admin.reports.byCategory']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i>
                    <span>Thống kê</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.reports']) }}">
                        <a class="nav-link" href="{{ route('admin.reports') }}">Thống kê doanh thu</a>
                    </li>
                </ul>
            </li>
            <li><a class="nav-link {{ setActive(['admin.messages.index']) }}"
                    href="{{ route('admin.message.index') }}"><i class="fas fa-user"></i>
                    <span>Messages</span></a></li>
            <li class="menu-header">Settings & More</li>
            <li
                class="dropdown {{ setActive([
                    'admin.user-list',
                    'admin.admin-list',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.user-list']) }}"><a class="nav-link"
                            href="{{ route('admin.user-list') }}">Danh sách Khách Hàng</a></li>
                    <li class="{{ setActive(['admin.admin-list']) }}"><a class="nav-link"
                            href="{{ route('admin.admin-list') }}">Admin Lists</a></li>
                </ul>
            </li>

        </ul>

    </aside>
</div>
