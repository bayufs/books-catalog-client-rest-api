@extends('frontend.base')
@section('title', 'Home-page')
@section('components')
<div class="templatemo_content_left_section">                
    <a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" vspace="8" border="0" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px"  src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" vspace="8" border="0" /></a>
</div>
</div> <!-- end of content left -->

<div id="templatemo_content_right">
    @if (empty($results))
        <h3>No Data Found</h3>
    @else
    @foreach ($results as $row_books)

    <div class="templatemo_product_box">
        <h1>{{ $row_books->title }}  <span>(by {{ $row_books->author }})</span></h1>
           <img src="http://localhost:8080/images/{{ $row_books->image }}" style="width:100px; " alt="image" />
            <div class="product_info">
                <p>{{ str_limit($row_books->description, 30) }}</p>
            
                <div class="buy_now_button"><a href="{{ $row_books->link }}">Buy Now</a></div>
                <div class="detail_button"><a href="{{ route('books.detail', ['id' => $row_books->id]) }}">Detail</a></div>
            </div>
            <div class="cleaner">&nbsp;</div>
        </div>  
@endforeach
        
    @endif

<a href="subpage.html"><img src="{{ asset('images/templatemo_ads.jpg') }}" alt="ads" /></a>
</div> <!-- end of content right -->

<div class="cleaner_with_height">&nbsp;</div>
</div> <!-- end of content -->
@endsection