@extends('layouts.app')
@section('title', 'Student form')
@section('content')

    <div class="container">
        <div class="mt-5">
            <form class="w-50" id="my-form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Add</button>
            </form>
            <span id="output"></span>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#my-form').submit(function(event) {
                event.preventDefault();
                
                var form = $("#my-form")[0];
                var data = new FormData(form);
                $('#btnSubmit').prop('disabled',true);
                

                $.ajax({
                    type: 'post',
                    url: '{{ route("student.store") }}',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('#output').text(data.res);
                        $('#btnSubmit').prop('disabled',false);
                        $("input[type='text'],input[type='email'],input[type='file']").val('');
                    },
                    error: function(e) {
                        $('#output').text(e.responseText);
                        $('#btnSubmit').prop('disabled',false);
                        $("input[type='text'],input[type='email'],input[type='file']").val('');
                        // console.log(e.responseText);
                    }
                });

            })
        });
    </script>
@endsection
