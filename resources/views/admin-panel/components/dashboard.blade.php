@extends('frontend.base')
@section('title', 'Admin Dashboard')
@section('components')
 
<div class="templatemo_content_left_section">                
    <a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" vspace="8" border="0" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px"  src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" vspace="8" border="0" /></a>
</div>
</div> <!-- end of content left -->

<div id="templatemo_content_right">
    <center>
        <a href="{{ url('admin/form-add-new-book') }}">Add New Book</a><br><br><br>
        <table border="1" width="600" celspacing="1" celpadding="1">
             <thead>
                 <th>No</th>
                 <th>Title</th>
                 <th>Author</th>
                 <th>Image</th>
                 <th>Date</th>
                 <th>Action</th>
             </thead>

             <tbody>
                 <?php $no = 1; ?>
                 @foreach ($paginatedItems as $results)
                 <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $results->title }}</td>
                        <td>{{ $results->author }}</td>
                        <td><img src="http://localhost:8080/images/{{ $results->image }}" style="width:70px" alt="" srcset=""></td>
                        <td>{{ \Carbon\Carbon::parse($results->created_at->date)->format('d F Y')}}</td>
                        <td><center><a href="{{ url('admin/edit-book/'.$results->id) }}">Edit</a> | <a href="{{ url('admin/delete-book/'.$results->id) }}">Delete</a></center></center></td>
                 </tr>  
                 <?php $no ++; ?>  
                 @endforeach
                 
                 
                 
             </tbody>
        </table>
        <div class="paginator">
                {{ $paginatedItems->links() }}
            </div>
     </center>	

</div> <!-- end of content right -->

<div class="cleaner_with_height">&nbsp;</div>
</div> 
@endsection