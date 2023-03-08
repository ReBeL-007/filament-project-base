<section class="header-section section">
    <!-- logo -->
    <a href="#" class="logo-link">
        <img src="{{ asset('site/img/asmita.png')}}" alt="" />
    </a>
    <form action="#" class="header-section__form">
        <div class="form__group">
            <input type="text" name="query" placeholder="Search for books by keyword / title / author"
                value="{{ request()->input('query')}}" required />
            <div class="delete__search">
                <i class="fas fa-times"></i>
            </div>
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- search -->
</section>
<!-- mobile tablet search -->
<a class="btn searchIcon">
    <i class="fas fa-search"></i>
    <form action="#" class="header-section__form myForm">
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
{{$slot}}