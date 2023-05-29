<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('1.png') }}" />
        </div>
        <div class="sidebar-brand-text mx-3">MicroMac</div>
    </a>
    <hr class="sidebar-divider my-0" />

    <div class="sidebar-heading mt-3">
        Menu
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('brand.index') }}">
            <i class="fas fa-arrow-alt-circle-right"></i>            
            <span>Brand</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('model.index') }}">
            <i class="fas fa-arrow-circle-right"></i>
            <span>Model</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('item.index') }}">
            <i class="fas fa-align-justify"></i>
            <span>Item</span>
        </a>
    </li>




</ul>
