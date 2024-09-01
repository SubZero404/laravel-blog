<div class="w-100 filter-div overflow-hidden mb-2">
    <div class="w-100 d-flex flex-row justify-content-around">
        <p class="fw-bold" style="cursor: pointer" onclick="toggleFilterDiv('.category-filter-div')">
            Categories <i class="bi bi-chevron-down text-secondary"></i>
        </p>
        <p class="fw-bold" style="cursor: pointer" onclick="toggleFilterDiv('.user-filter-div')">
            Author <i class="bi bi-chevron-down text-secondary"></i>
        </p>
    </div>
    <div class="row category-filter-div d-none animate__animated animate__fadeOutUp">
        @foreach(\App\Models\Category::all() as $category)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 my-2 text-center">
                <a href="#" class="text-decoration-none text-light fst-italic fw-light">{{ $category->title }}</a>
            </div>
        @endforeach
    </div>
    <div class="row user-filter-div d-none animate__animated animate__fadeOutUp">
        @foreach(\App\Models\User::all() as $user)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 my-2 text-center">
                <a href="#" class="text-decoration-none text-light fst-italic fw-light">{{ $user->name }}</a>
            </div>
        @endforeach
    </div>
</div>

@push('script')
    <script>
        function toggleFilterDiv(filter_div) {
            let delay = false;
            delay = checkToggle(filter_div)
            filter_div = document.querySelector(filter_div);

            if(delay) {
                setTimeout(function (){
                    toggleFiler(filter_div)
                },1000)
            } else {
                toggleFiler(filter_div)
            }

        }

        function toggleFiler(filter_div) {
            if (filter_div.classList.contains('d-none')) {
                // If currently hidden, remove 'd-none' and add 'animate__fadeInDown'
                filter_div.classList.remove('d-none');
                filter_div.classList.remove('animate__fadeOutUp');
                filter_div.classList.add('animate__fadeInDown');
            } else {
                // If currently visible, add 'animate__fadeOutUp'
                filter_div.classList.remove('animate__fadeInDown');
                filter_div.classList.add('animate__fadeOutUp');

                // Wait for the animation to complete before hiding the element
                filter_div.addEventListener('animationend', function() {
                    filter_div.classList.add('d-none');
                }, { once: true });
            }
        }

        function checkToggle(current_div) {
            if (current_div === '.category-filter-div') {
                let user_filter_div = document.querySelector('.user-filter-div');
                if(!user_filter_div.classList.contains('d-none')) {
                    toggleFilterDiv('.user-filter-div');
                    return true;
                } else {
                    return false;
                }
            } else {
                let category_filter_div = document.querySelector('.category-filter-div');
                if(!category_filter_div.classList.contains('d-none')) {
                    toggleFilterDiv('.category-filter-div',false);
                    return true;
                } else {
                    return false;
                }
            }
        }


    </script>
@endpush
