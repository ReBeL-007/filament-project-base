<section class="sub-header__container">
    <!-- nav section -->
    <nav class="section-nav">
        <input type="checkbox" id="check" />
        <div class="hamburger-menu-container">
            <div class="hamburger-menu">
                <div></div>
            </div>
        </div>
        <div class="logo-container">
            <a href="{{route('index')}}" class="logo-container__link">
                <img src="{{ asset('site/img/asmita.png')}}" alt="" />
            </a>
        </div>
        <!-- desktop nav and then transformed into mobile now -->
        <div class="nav-btn">
            <!-- after sticky should be displayed -->
            <div class="logo-container">
                <a href="{{route('index')}}" class="logo-container__link">
                    <img src="{{asset('site/img/asmita.png')}}" alt="" />
                </a>
            </div>
            <div class="nav-links">
                <ul>
                    @foreach($frontCategories as $parentCategory)
                    <li class="nav-link">
                        <a href="{{ route('category', [$parentCategory]) }}">{{$parentCategory->name}} <i
                                class="fas fa-caret-down {{($parentCategory->childCategories->count())?'':'opacity'}}"></i></a>
                        @if($parentCategory->childCategories->count())
                        <div class="dropdown">
                            <ul>
                                @foreach($parentCategory->childCategories as $category)
                                <li class="dropdown-link">
                                    <a href="{{ route('category', [$parentCategory, $category]) }}">
                                        {{$category->name}} <i
                                            class="fas fa-caret-right {{$category->childCategories->count()?'':'opacity'}}"></i></a>
                                    @if($category->childCategories->count())
                                    <div class="dropdown nested">
                                        <ul>
                                            @foreach($category->childCategories as $childCategory)
                                            <li class="dropdown-link">
                                                <a
                                                    href="{{ route('category', [$parentCategory, $category, $childCategory->slug]) }}">
                                                    {{$childCategory->name}}
                                                    <i
                                                        class="fas fa-caret-right {{$childCategory->childCategories->count()?'':'opacity'}}"></i></a>
                                                @if($childCategory->childCategories->count())
                                                <div class="dropdown nested">
                                                    <ul>
                                                        @foreach($childCategory->childCategories as
                                                        $subCategory)
                                                        <li class="dropdown-link">
                                                            <a
                                                                href="{{ route('category', [$parentCategory, $category, $childCategory->slug, $subCategory->slug]) }}">
                                                                {{$subCategory->name}}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                        <div class="arrow"></div>
                                                    </ul>
                                                </div>
                                                @endif
                                            </li>
                                            @endforeach
                                            <div class="arrow"></div>
                                        </ul>
                                    </div>
                                    @endif
                                </li>
                                @endforeach
                                <div class="arrow"></div>
                            </ul>
                        </div>
                        @endif
                    </li>
                    @endforeach
                    <li class="nav-link">
                        <a href="{{ route('contact') }}">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>
            <div class="nav-sign">
                <div>
                    <a href="{{route('cart')}}">
                        <i class="fa fa-shopping-cart" aria-hidden="true">
                        </i></a>



                    @if(auth::user()==null)
                    @php
                    $count = 0;
                    $value = Session::get('cart');
                    if($value!=null)
                    {
                    foreach($value as $cart)
                    {
                    $count+=count((array)$cart);
                    }
                    }

                    @endphp
                    <span class="badge badge-pill badge-danger">{{ $count }}</span>
                    @else
                    @php
                    $userCart = auth::user()->cart;
                    @endphp
                    @if(!isset($userCart))
                    <span class="badge badge-pill badge-danger">{{ count((array)$userCart) }}</span>
                    @else
                    <span class="badge badge-pill badge-danger">{{ count(auth::user()->cart->products) }}</span>
                    @endif
                    @endif

                </div>

                @guest
                <a href="{{ route('login') }}" class="sign-in"><i class="fas fa-user"></i> <span> Sign
                        In</span></a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="register">
                    <i class="fas fa-user-plus"></i>
                    <span>Register</span></a>
                @endif
                @else
                <a id="navbarDropdown" class="nav-link dropdown-toggle register" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                    <div class="dropdown-menu dropdown-menu-right dropdown" aria-labelledby="navbarDropdown">
                        <button class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </button>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </a>
                @endguest
            </div>
            <!-- visible after sticky -->
            <a class="btn sticky-search">
                <i class="fas fa-search"></i>
                <form action="{{route('search')}}" class="header-section__form sticky-form">
                    <div class="form__group">
                        <input type="text" name="query" placeholder="Search for books by keyword / title / author"
                            value="{{ request()->input('query')}}" required />
                        <div class="delete__search">
                            <i class="fas fa-times"></i>
                        </div>
                        <button class="search-btn"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </a>
        </div>
    </nav>
</section>