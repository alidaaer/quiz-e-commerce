@extends('layout.main')

@section('content')




    <h2>Create A Category</h2>
    <form method="POST" id="add-category" action="{{ route('create-category') }}">
        @csrf
        <input type="text" name="name">
        <input type="submit">
    </form>
    <table class="table  table-striped"  cellpadding="20">
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>

        @foreach($Categories as $cat)
        <tr>
            <td>{{$cat->id}}</td>
            <td>{{$cat->name}}</td>
            <td>
                <a href="{{ route('update-category', $cat->id) }}" class="edit">Update</a>
                <a 
                        href="javascript:void(0)" 
                        class="delete-category" 
                        data-url="{{ route('delete-category', $cat->id) }}" 
                        class="btn btn-info"
                        >Delete</a>
            </td>

        </tr>
        @endforeach
    </table>
    

    <script>









        $("table").on("click",".delete-category",function(){
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

        $("#add-category").on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
               type:'POST',
               url:form.attr("action"),
               data:form.serialize(),
               success:function(data) {
                console.log(data.data);
                alert(data.message)
                  $("#msg").html(data.msg)
                  id=data.data.id
                  $('table tr:last').after("<tr><td>"+data.data.id+
                  "</td><td>"+data.data.name+"</td>"+
                  "<td><a href='/api/update-category/"+id+"'>Update</a><a href='javascript:void(0)' class='delete-category' data-url='/api/delete-category/"+id+"'class='btn btn-info'>Delete</a></td></tr>");

                  getAllCategories()
               }
            });
        })
    </script>
@stop