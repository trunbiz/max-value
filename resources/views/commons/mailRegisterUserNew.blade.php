<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Publisher.maxvalue.media There's a new subscriber</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card mt-3">
        <div class="card-header">
            <img style="max-width: 100px"
                 src="https://publisher.maxvalue.media/assets/single/1/1/original/tvGfOmbDbyXjU2VqXoIo.png"
                 alt="Logo công ty">
        </div>
        <div class="card-body">
            <h2 class="card-title">Publisher.maxvalue.media There's a new subscriber</h2>
            <p>Hello {{$userAdmin}},</p>

            <p>There is a new registered user on Publisher.maxvalue.media. Here are the details:</p>

            <ul class="list-group">
                <li class="list-group-item"><strong>Name:</strong> {{$nameUser}}</li>
                <li class="list-group-item"><strong>Email:</strong> {{$emailUser}}</li>
                <li class="list-group-item"><strong>Created at:</strong> {{$dateUser}}</li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
