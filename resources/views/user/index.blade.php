@extends('layouts.app')

@section('content')
    <div class="m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house"></i>
                    <a href="{{ route('home') }}" class=""> Home</a>
                </li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </nav>
    </div>

    {{--    card start--}}
    <div class="container-fluid p-0 overflow-scroll scrollbar window-session bg-black rounded">
        <div class="card bg-black border-0">
            {{--            card header--}}
            <div class="card-header d-flex justify-content-between mx-2">
                <div class="d-flex align-items-center">
                    <i class="bi bi-people-fill fs-4"></i>
                    <span class="fw-bolder ms-2">Users</span>
                </div>
                <div class="search-form @if(!request('keyword')) d-none  @endif">
                    <form action="{{ route('post.index') }}" method="get">
                        <div class="input-group">
                            <input type="text" value="{{ request('keyword') }}" name="keyword" id="keyword" class="form-control" placeholder="Search">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-dark custom-btn me-2" onclick="toggle_search()">
                        <i class="bi bi-search"></i>
                    </button>
                    @push('script')
                        <script>
                            function toggle_search() {
                                document.querySelector('.search-form').classList.toggle('d-none')
                            }
                        </script>
                    @endpush
                    <button class="btn btn-dark custom-btn me-2" onclick="toggle_window(this)">
                        <i class="bi bi-arrows-angle-expand"></i>
                        <i class="bi bi-arrows-angle-contract d-none"></i>
                    </button>
                    @push('script')
                        <script>
                            function toggle_window(e) {
                                e.children[0].classList.toggle('d-none')
                                e.children[1].classList.toggle('d-none')
                                document.querySelector('.window-session').classList.toggle('window-expand')
                            }
                        </script>
                    @endpush
                </div>
            </div>
            {{--            card body--}}
            <div class="card-body">
                @if(request('keyword'))
                    <div class="m-2">
                        <p>
                            Search By
                            <span class="text-secondary me-2">"{{ request('keyword') }}"</span>
                            <small>
                                <a href="{{ route('post.index') }}">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </small>
                        </p>
                    </div>
                @endif
                <table class="table table-striped table-hover overflow-scroll">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        @manageLvl
                        <th>ROLE</th>
                        <th class="text-nowrap">CREATED DATE</th>
                        @endmanageLvl
                        @adminLvl
                        <th>CONTROL</th>
                        @endadminLvl

                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @forelse($users as $user)
                        <tr class="category-tr" id="category-tr-{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>
                                <p class="my-0">{{ $user->name }}</p>
                            </td>
                            <td>
                                <p>{{ $user->email }}</p>
                            </td>
                            @manageLvl
                            <td>
                                <p>{{ $user->role }}</p>
                            </td>
                            <td>
                                <p class="my-0 text-nowrap"><i class="bi bi-calendar me-1"></i> {{ $user->created_at->format('d M Y') }}</p>
                                <p class="my-0 text-nowrap"><i class="bi bi-clock me-1"></i> {{ $user->created_at->format('h : m A') }}</p>
                            </td>
                            @endmanageLvl
                            @adminLvl
                            <td class="text-nowrap">
                                {{--                                            delete post form--}}
                                <form action="{{ route('user.destroy',$user->id) }}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-dark custom-btn me-2 mb-2">
                                        <i class="text-danger bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                            @endadminLvl
                        </tr>
                    @empty
                        <tr>
                            <td colspan="@if(Auth::user()->isAuthor()) 5 @else 6 @endif">
                                <div class="d-flex justify-content-center align-items-center" style="height: 50vh">
                                    <h2>Found Nothing</h2>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="">
                    {{ $users->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
    {{--    card end--}}
@endsection
