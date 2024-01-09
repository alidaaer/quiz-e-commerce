@extends('layout.main')

@section('content')




    <h2>Create A Product</h2>
    <form method="POST" id="add-product" action="{{ route('create-product') }}">
        @csrf
        <input type="text" name="name">
        <select name="category_id">
        @foreach($Categories as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
        </select>
        <input type="file" name="image" id="image">
        <input type="submit">
    </form>
    <table class="table  table-striped" border=1 cellpadding="20">
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Actions</th>

        @foreach($Products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td><img src="storage/{{$product->image}}" height="40"></td>
            <td>{{$product->name}}</td>
            <td>{{$product->category->name}}</td>

            <td>
                <a href="/update-product/{{$product->id}}" class="edit">Update</a>
                <a 
                        href="javascript:void(0)" 
                        class="delete-product" 
                        data-url="/api/delete-product/{{$product->id}}" 
                        class="btn btn-info"
                        >Delete</a>
            </td>

        </tr>
        @endforeach
    </table>
    

    <script>

        $("table").on("click",".delete-product",function(){
            element = $(this)
            $.ajax({
               type:'GET',
               url:element.attr("data-url"),
               success:function(data) {
                alert(data.message)
                  $("#msg").html(data.msg);
                  element.parent().parent().remove()
               }
            });
        })

        $("#add-product").on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData();

            var name = $("input[name=name]").val();
            var category_id = $("select[name=category_id]").val();
            var category_name = $("select[name=category_id] option:selected").text();;

            // formData = form.serialize()
            let _token = $('meta[name="csrf-token"]').attr('content');

            var photo = $('#image').prop('files')[0];   
            formData.append('name', name);
            formData.append('image', photo)
            formData.append('category_id', category_id)
            formData.append('_token', _token)

            $.ajax({
               type:'POST',
               url:form.attr("action"),
               contentType: 'multipart/form-data',
               data:formData,
               cache: false,
                contentType: false,
                processData: false,
               success:function(data) {
                console.log(data.data);
                alert(data.message)
                  $("#msg").html(data.msg)
                  id=data.data.id
                  $('table tr:last').after("<tr><td>"+data.data.id+"</td>"+
                  "<td><img src='storage/"+data.data.image+"' height='40'></td>"+
                  "<td>"+data.data.name+"</td>"+
                  "<td>"+category_name+"</td>"+
                  "<td><a href='/update-product/"+id+"'>Update</a>"+
                  "<a href='javascript:void(0)' class='delete-product' data-url='/api/delete-product/"+id+"'class='btn btn-info'>Delete</a></td></tr>");

                 
               }
            });
        })
    </script>
@stop