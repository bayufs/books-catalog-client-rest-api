<div id="templatemo_content">
    	
    <div id="templatemo_content_left">
        <div class="templatemo_content_left_section">
            <h1>Categories</h1>
            <ul>
                @foreach ($response_category->data as $row_category)
                <li><a href="{{ route('books.category', ['id'=> $row_category->id]) }}">{{ $row_category->name }}</a></li>    
                @endforeach
                

            </ul>
        </div>
        <div class="templatemo_content_left_section">
            @if(Session::has('is_login'))
            
            <a href="{{ url('/logout') }}">Logout</a>
            
            @else
            
            <a href="{{ url('/login') }}">Login</a> | <a href="{{ url('/register') }}">Register</a> 

            @endif
                    </div>
        
  