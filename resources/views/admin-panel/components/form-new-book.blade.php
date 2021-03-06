@extends('frontend.base')
@section('title', 'Form Add New Book')
@section('components')
 
<div class="templatemo_content_left_section">                
    <a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" vspace="8" border="0" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px"  src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" vspace="8" border="0" /></a>
</div>
</div> <!-- end of content left -->

<div id="templatemo_content_right">
        <form action="{{ url('admin/add-new-book') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="group">
                <label for="">Title</label><br>
                <input type="text" name="title" placeholder="Title">
            </div>

            <div class="group">
                    <label for="">Category</label><br>
                    <select name="category_id" id="">
                        <option value="">-- Choose --</option>
                        @foreach ($response_category->data as $rows_category)
                        <option value="{{ $rows_category->id }}">{{ $rows_category->name }}</option>    
                        @endforeach
                    </select>
            </div>
            
            <div class="group">
                    <label for="">Author</label><br>
                    <input type="text"  name="author" placeholder="Author">
            </div>
            <div class="group">
                    <label for="">Description</label><br>
                    <textarea name="description" id="" name="description" placeholder="Description" cols="30" rows="10"></textarea>
            </div>
            <div class="group">
                    <label for="">Image</label><br>
                    <input type="file" name="image">
            </div>
            
            <div class="group">
                    <label for="">Link</label><br>
                    <input type="text" name="link" placeholder="Link">
            </div>
            
            <div class="group">
                    <label for="">Featured</label><br>
                    <select name="featured" id="">
                        <option value="0">Show</option>
                        <option value="1">Hide</option>
                    </select>
            </div>
            <div class="group">
                <button type="submit">Post Book</button>
                <button type="reset">Clear</button>
            </div>

        </form>	

</div> <!-- end of content right -->

<div class="cleaner_with_height">&nbsp;</div>
</div> 
@endsection