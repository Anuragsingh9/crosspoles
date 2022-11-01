<html>
<head>
    <title>User Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-1">
            <form class="form-wrapper" id="user-form" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-5 form-item">
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="col-md-5  form-item">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="col-md-5 form-item">
                        <input type="text" class="form-control" placeholder="Phone" name="phone">
                    </div>
                    <div class="col-md-5 form-item">
                        <input type="text" class="form-control" placeholder="Role Id" name="role">
                    </div>
                    <div class="col-md-5 form-item">
                        <input type="file" class="custom-file-input file-data" id="validatedCustomFile" name="file"
                               required>
                        <label class="custom-file-label input-file" for="validatedCustomFile">Choose file...</label>
                    </div>
                    <div class="col-md-5 form-item">
                        <textarea type="text" class="form-control" placeholder="Description"
                                  name="description"></textarea>
                    </div>
                    <div class="col-md-10 form-item">
                        <div class="col-md-8 offset-2 ">
                            <button type="submit" class="form-control sbmt-btn">Save</button>
                        </div>
                    </div>
                    <div class="col-md-10 form-item">
                        <ul class="alert alert-danger" id="error_list"></ul>
                        <table class="table">
                            <tbody class="table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>


<script>

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit', '#user-form', function (e) {
            e.preventDefault();
            let formData = new FormData($('#user-form')[0]);
            $.ajax({
                type: 'POST',
                url: "/create-user",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data); // show response from the php script.
                    $('.table').html('');
                    $('.table').append(
                        `<thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Description</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Role</th>
                                <th scope="col">Image</th>
                            </tr>
                            </thead>`
                        +
                        '<tbody class="table-body">' +
                        '<tr>' + '<td>' + data.data.name + '</td>' +
                        '<td>' + data.data.email + '</td>' +
                        '<td>' + data.data.description + '</td>' +
                        '<td>' + data.data.phone + '</td>' +
                        '<td>' + data.data.role + '</td>' +
                        '<td>' +
                        '<img src="http://127.0.0.1:8000/storage/' + data.data.filepath + '">' + '</td>' +
                        '</tr>' +
                        '</tbody>'
                    )
                    console.log('name', data.data.name)
                },

                error: function (data) {
                    const errors = data.responseJSON;
                    console.log(errors);
                    $('#error_list').html('');
                    $('#error_list').addClass('displayBlock');
                    $.each(errors.errors, function (key, value) {
                        $('#error_list').append('<li>' + value + '</li>')
                    });
                }
            });
        });
    });

</script>
</html>
