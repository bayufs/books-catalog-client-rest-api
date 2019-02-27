@extends('frontend.base')
@section('title', 'Detail-page')
@section('components')

<div class="templatemo_content_left_section">                
    <a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" vspace="8" border="0" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px"  src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" vspace="8" border="0" /></a>
</div>
</div> <!-- end of content left -->

<div id="templatemo_content_right">

<h1>{{ $results->title }} <span>(by {{ $results->author }})</span></h1>
<div class="image_panel"><img src="http://localhost:8080/images/{{ $results->image }}" alt="CSS Template" width="100" height="150" /></div>
<ul>
    <li>By  <a href="#">{{ $results->author }}</a></li>
    <li>{{ \Carbon\Carbon::parse($results->created_at->date)->format('d F Y')}}</li>
    
</ul>

<p>{{ $results->description }}</p>

 <div class="cleaner_with_height">&nbsp;</div>

<a href="index.html"><img src="{{ asset('images/templatemo_ads.jpg') }}" alt="css template ad" /></a>

</div> <!-- end of content right -->

<div class="cleaner_with_height">&nbsp;</div>
</div> 
@endsection










