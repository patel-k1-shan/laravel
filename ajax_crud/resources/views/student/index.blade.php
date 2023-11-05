@extends('layouts.app')
@section('title', 'Student Index')
@section('content')

    <div class="container">
        <div class="mt-5">

            <div id="output"></div>
            <table class="table table-hover" id="edit_table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="students-data">
                   
                </tbody>
            </table>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: " {{route('student.getstudentajax')}} ",
                success: function(data) {
                    console.log(data);
                    if(data.students.length > 0) {
                        for(let i = 0; i < data.students.length; i++) {
                            let img = data.students[i]['image'];
                            $("#students-data").append(`
                            <tr>
                                <td>`+ i+1 +`</td>
                                <td>`+ data.students[i]['name'] +`</td>
                                <td>`+ data.students[i]['email'] +`</td>
                                <td>
                                   <img src="images/`+img+`" width="100" alt="`+img+`" />
                                </td>
                                <td>
                                    <a href="student/edit/`+data.students[i]['id']+`">Edit</a>
                                    <a href="#" class="student_delete" data-id="`+data.students[i]['id']+`">Delete</a>
                                </td>
                            </tr>
                            `);
                        }
                    }else {
                        $('#students-data').append("<tr><td colspan='5'>No Data found</td></tr>");
                    }
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            });

            $('#edit_table').on('click','.student_delete',function() {
                var id = $(this).attr('data-id');
                var obj = $(this);
                $.ajax({
                    type: "GET",
                    url: "student/delete/"+id,
                    success: function(data) {
                        $(obj).parent().parent().remove();
                        $('#output').text(data.result);
                    },
                    error: function(err) {
                        console.log(err.responseText);
                    }
                });
            })

        });
    </script>

@endsection
