@extends('layouts.app')
@section('title','Student Edit')
@section('content')

<div class="container">
    <div class="mt-5">
        <form class="w-50" id="update-form">
            {{-- {{dd($student[0])}} --}}
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{$student[0]->name}}" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="{{$student[0]->email}}" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image">
                <img src="{{ asset('images/') }}/{{$student[0]->image}}" width="100" class="mt-2" alt="">
            </div>
            <input type="text" name="id" value="{{$student[0]->id}}">
            <button type="submit" class="btn btn-primary" id="btnSubmit">Update</button>
        </form>
        <span id="output"></span>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#update-form').submit(function(event) {
            event.preventDefault();

            var form = $("#update-form")[0];
            var data = new FormData(form);

            $.ajax({
                type: "post",
                url: "{{ route('student.update') }}",
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#output').text(data.result);
                    window.open("/","_self");
                },
                error: function(err) {
                    $('#output').text(err.response);
                }
            });
        });
    });
</script>

@endsection