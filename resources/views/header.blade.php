<header>
    @if(session('is_logged_in'))
    <div style="margin-left:20px;margin: bottom 20px;">
        <table border="1" cellpadding="20">

            @if(!request()->route()->named('profile')) <td><a href="{{route('profile')}}">Profile</a></td>@endif
            @if(!request()->routeIs('authors.*')) <td><a href="{{route('authors.index')}}">Authors</a></td>@endif
            @if(!request()->routeIs('books.*')) <td><a href="{{route('books.create')}}">Create Book</a></td>@endif
            
            @if(!request()->route()->named('dashboard')) <td><a href="{{route('dashboard')}}">dashboard</a></td>@endif
             <td><a href="{{route('logout')}}">Logout</a></td>
             @endif
            </table>
        </div>
    
    @if(session('main_error'))
    <p>{{session('main_error')}}</p>
    @endif
    @if(session('main_success'))
    <p>{{session('main_success')}}</p>
    @endif

</header>