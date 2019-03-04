@extends('frontend.base')
@section('title', 'Form Edit Book')
@section('components')
 
<div class="templatemo_content_left_section">                
    <a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" vspace="8" border="0" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px"  src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" vspace="8" border="0" /></a>
</div>
</div> <!-- end of content left -->

<div id="templatemo_content_right">
        <form action="{{ url('admin/edit-book') }}" method="post" enctype="multipart/form-data">
            @csrf  @method('put')
            <div class="group">
                <label for="">Title</label><br>
                <input type="text" name="title" value="{{ $result->data->title }}" placeholder="Title">
            </div>

            <div class="group">
                    <label for="">Category</label><br>
                    <select name="category_id" id="">
                        <option value="">-- Choose --</option>
                        @foreach ($response_category->data as $rows_category)
                        <option value="{{ $rows_category->id }}" {{ $rows_category->id == $result->data->category_id ? 'selected' : '' }}>{{ $rows_category->name }}</option>    
                        @endforeach
                    </select>
            </div>
            
            <div class="group">
                    <label for="">Author</label><br>
                    <input type="text"  name="author" value="{{ $result->data->author }}" placeholder="Author">
            </div>
            <div class="group">
                    <label for="">Description</label><br>
                    <textarea name="description" id="" name="description" placeholder="Description" cols="30" rows="10">{{ $result->data->description }}</textarea>
            </div>
            <div class="group">
                    <label for="">Image</label><br>
                    <input type="file" name="image">
            </div>
            
            <div class="group">
                    <label for="">Link</label><br>
                    <input type="text" name="link" value="{{ $result->data->author }}" placeholder="Link">
            </div>
            
            <div class="group">
                    <label for="">Featured</label><br>
                    <select name="featured" id="">
                        <option value="#">-Pilih-</option>
                        <option value="0" {{ $result->data->featured == 0 ? 'selected' : '' }}>Show</option>
                        <option value="1" {{ $result->data->featured == 1 ? 'selected' : '' }}>Hide</option>
                    </select>
            </div>
            <div class="group">
                
                <input type="hidden" name="book_id" value="{{ $result->data->id }}" placeholder="Link">
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