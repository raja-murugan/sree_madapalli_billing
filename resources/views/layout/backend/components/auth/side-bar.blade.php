<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Menu</h6>
                    <ul>
                        <li class="{{ Route::is('home') ? 'active' : '' }} m-2">
                            <a href="{{ route('home') }}"><i data-feather="grid"></i><span>Dashboard</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">OutDoor</h6>
                    <ul>
                        
                        <li class="{{ Route::is('outdoor_product.index', 'outdoor_product.store') ? 'active' : '' }}">
                            <a href="{{ route('outdoor_product.index') }}"><i data-feather="box"></i><span>Product</span></a>
                        </li>
                        <li class="{{ Route::is('outdoor.index', 'outdoor.store', 'outdoor.datefilter', 'outdoor.create') ? 'active' : '' }}">
                            <a href="{{ route('outdoor.index') }}"><i data-feather="credit-card"></i><span>OutDoor</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Sales</h6>
                    <ul>
                        <li class="{{ Route::is('session.index', 'session.store') ? 'active' : '' }}">
                            <a href="{{ route('session.index') }}"><i data-feather="credit-card"></i><span>Session</span></a>
                        </li>
                        <li class="{{ Route::is('category.index', 'category.store') ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}"><i data-feather="credit-card"></i><span>Category</span></a>
                        </li>
                        <li class="{{ Route::is('product.index', 'product.store') ? 'active' : '' }}">
                            <a href="{{ route('product.index') }}"><i data-feather="box"></i><span>Product</span></a>
                        </li>
                        <li class="{{ Route::is('productsession.index', 'productsession.store') ? 'active' : '' }}">
                            <a href="{{ route('productsession.index') }}"><i data-feather="box"></i><span>Product Session</span></a>
                        </li>
                        <li class="{{ Route::is('sales.index', 'sales.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('sales.index') }}"><i data-feather="shopping-cart"></i><span>Sales</span></a>
                        </li>
                        <li class="{{ Route::is('salespayment.index') ? 'active' : '' }}">
                            <a href="{{ route('salespayment.index') }}"><i data-feather="shopping-cart"></i><span>Sales Payment</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Purchase</h6>
                    <ul>
                        <li class="{{ Route::is('purchase_product.index', 'purchase_product.store') ? 'active' : '' }}">
                            <a href="{{ route('purchase_product.index') }}"><i data-feather="credit-card"></i><span>Product</span></a>
                        </li>
                        <li class="{{ Route::is('supplier.index', 'supplier.store') ? 'active' : '' }}">
                            <a href="{{ route('supplier.index') }}"><i data-feather="credit-card"></i><span>Supplier</span></a>
                        </li>
                        <li class="{{ Route::is('purchase.index', 'purchase.store', 'purchase.edit', 'purchase.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('purchase.index') }}"><i data-feather="credit-card"></i><span>Purchase</span></a>
                        </li>
                        <li class="{{ Route::is('purchasepayment.index') ? 'active' : '' }}">
                            <a href="{{ route('purchasepayment.index') }}"><i data-feather="shopping-cart"></i><span>Purchase Payment</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Attendance</h6>
                    <ul>
                        <li class="{{ Route::is('emp_attendance.index', 'emp_attendance.store', 'emp_attendance.datefilter', 'emp_attendance.create', 'emp_attendance.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('emp_attendance.index') }}"><i data-feather="credit-card"></i><span>Employee Attendance</span></a>
                        </li>
                        <li class="{{ Route::is('delivery_attendance.index', 'delivery_attendance.store', 'delivery_attendance.datefilter', 'delivery_attendance.create', 'delivery_attendance.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('delivery_attendance.index') }}"><i data-feather="credit-card"></i><span>Delivery Attendance</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Expense</h6>
                    <ul>
                        <li class="{{ Route::is('expense.index', 'expense.store', 'expense.datefilter', 'expense.create') ? 'active' : '' }}">
                            <a href="{{ route('expense.index') }}"><i data-feather="credit-card"></i><span>Expense</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Pay Off</h6>
                    <ul>
                        
                        <li class="{{ Route::is('payoff.index', 'payoff.store', 'payoff.create', 'payoff.edit', 'payoff.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('payoff.index') }}"><i data-feather="box"></i><span>Employee Payoff</span></a>
                        </li>
                        <li class="{{ Route::is('deliveryboyspayoff.index', 'deliveryboyspayoff.store', 'deliveryboyspayoff.create', 'deliveryboyspayoff.edit', 'deliveryboyspayoff.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('deliveryboyspayoff.index') }}"><i data-feather="box"></i><span>Deliveryboys Payoff</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">General</h6>
                    <ul>
                        <li class="{{ Route::is('bank.index', 'bank.store') ? 'active' : '' }}">
                            <a href="{{ route('bank.index') }}"><i data-feather="credit-card"></i><span>Payment Mode</span></a>
                        </li>
                        <li class="{{ Route::is('customer.index', 'customer.store', 'customer.edit', 'customer.delete', 'customer.checkduplicate') ? 'active' : '' }}">
                            <a href="{{ route('customer.index') }}"><i data-feather="user"></i><span>Customers</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Delivery</h6>
                    <ul>
                        <li class="{{ Route::is('delivery.area.index', 'delivery.area.store') ? 'active' : '' }}">
                            <a href="{{ route('delivery.area.index') }}"><i data-feather="map"></i><span>Delivery Areas</span></a>
                        </li>
                        <li class="{{ Route::is('delivery.boy.index', 'delivery.boy.store') ? 'active' : '' }}">
                            <a href="{{ route('delivery.boy.index') }}"><i data-feather="user"></i><span>Delivery Boys</span></a>
                        </li>
                        <li class="{{ Route::is('delivery.plan.index', 'delivery.plan.store') ? 'active' : '' }}">
                            <a href="{{ route('delivery.plan.index') }}"><i data-feather="map"></i><span>Delivery Plan</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">User Management</h6>
                    <ul>
                        <li class="{{ Route::is('employee.index', 'employee.store', 'employee.edit', 'employee.delete', 'employee.checkduplicate') ? 'active' : '' }}">
                            <a href="{{ route('employee.index') }}"><i data-feather="user"></i><span>Employee</span></a>
                        </li>
                        <li class="{{ Route::is('manager.invite.index', 'manager.invite.store') ? 'active' : '' }}">
                            <a href="{{ route('manager.invite.index') }}"><i data-feather="user-check"></i><span>Manager</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Accounts</h6>
                    <ul>
                        <li class="{{ Route::is('openaccount.index', 'openaccount.store') ? 'active' : '' }}">
                            <a href="{{ route('openaccount.index') }}"><i data-feather="credit-card"></i><span>Open Account</span></a>
                        </li>
                        <li class="{{ Route::is('dinomination.index', 'dinomination.store', 'dinomination.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('dinomination.index') }}"><i data-feather="credit-card"></i><span>Denomination</span></a>
                        </li>
                        <li class="{{ Route::is('closeaccount.index', 'closeaccount.store') ? 'active' : '' }}">
                            <a href="{{ route('closeaccount.index') }}"><i data-feather="credit-card"></i><span>Close Acccount</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>


