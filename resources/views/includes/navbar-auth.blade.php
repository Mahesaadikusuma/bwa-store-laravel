<nav
            class="navbar navbar-expand-lg navbar-store fixed-top navbar-fixed-top bg-light"
            data-aos="fade-down"
        >
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}"
                    ><img src="images/logo.svg" alt=""
                /></a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a
                                class="nav-link ms-lg-3 active"
                                aria-current="page"
                                href="{{ route('home') }}"
                                >Home</a
                            >
                        </li>

                        <li class="nav-item">
                            <a class="nav-link ms-lg-3" href="{{ route('categories') }}">Categories</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link ms-lg-3" href="#">Rewards</a>
                        </li>

                      
                    </ul>
                </div>
            </div>
        </nav>